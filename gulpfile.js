const { src, dest, watch, series, parallel, lastRun } = require("gulp");
const gulpLoadPlugins = require("gulp-load-plugins");
const fs = require("fs");
const mkdirp = require("mkdirp");
const Modernizr = require("modernizr");
const browserSync = require("browser-sync");
const del = require("del");
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");
const revDel = require("rev-del");
const { argv } = require("yargs");

const $ = gulpLoadPlugins();
const server = browserSync.create();

const port = argv.port || 9000;

const isProd = process.env.NODE_ENV === "production";
const isTest = process.env.NODE_ENV === "test";
const isDev = !isProd && !isTest;

// Srite svg config
const config = {
  mode: {
    inline: true, // Prepare for inline embedding
    symbol: true
  }
};

function convertSvg() {
  return src("app/images/svg/*.svg")
    .pipe($.svgSprite(config))
    .pipe(dest("app/assets"));
  //.pipe($.if(!isProd, dest('.tmp/assets'), dest('dist/assets')));
}

function revRename() {
  return src([
    "dist/**/*.css",
    "dist/**/*.js",
    "dist/**/*.{jpg,png,jpeg,gif,svg}"
  ])
    .pipe($.rev())
    .pipe(dest("dist"))
    .pipe($.rev.manifest({ path: "manifest.json" }))
    .pipe(revDel({ dest: "dist" }))
    .pipe(dest("dist"));
}

function revUpdateRef() {
  return src(["dist/manifest.json", "dist/**/*.{html,json,css,js}"])
    .pipe($.revCollector())
    .pipe(dest("dist"));
}

function styles() {
  return src("app/styles/**/*.scss")
    .pipe($.plumber())
    .pipe($.if(!isProd, $.sourcemaps.init()))
    .pipe(
      $.sass
        .sync({
          outputStyle: "expanded",
          precision: 10,
          includePaths: ["."]
        })
        .on("error", $.sass.logError)
    )
    .pipe($.postcss([autoprefixer()]))
    .pipe($.if(!isProd, $.sourcemaps.write()))
    .pipe(dest(".tmp/styles"))
    .pipe(server.reload({ stream: true }));
}

function scripts() {
  return src("app/scripts/**/*.js")
    .pipe($.plumber())
    .pipe($.if(!isProd, $.sourcemaps.init()))
    .pipe($.babel())
    .pipe($.if(!isProd, $.sourcemaps.write(".")))
    .pipe(dest(".tmp/scripts"))
    .pipe(server.reload({ stream: true }));
}

async function modernizr() {
  const readConfig = () =>
    new Promise((resolve, reject) => {
      fs.readFile(`${__dirname}/modernizr.json`, "utf8", (err, data) => {
        if (err) reject(err);
        resolve(JSON.parse(data));
      });
    });
  const createDir = () =>
    new Promise((resolve, reject) => {
      mkdirp(`${__dirname}/.tmp/scripts`, err => {
        if (err) reject(err);
        resolve();
      });
    });
  const generateScript = config =>
    new Promise((resolve, reject) => {
      Modernizr.build(config, content => {
        fs.writeFile(`${__dirname}/.tmp/scripts/modernizr.js`, content, err => {
          if (err) reject(err);
          resolve(content);
        });
      });
    });

  const [config] = await Promise.all([readConfig(), createDir()]);
  await generateScript(config);
}

const lintBase = files => {
  return src(files)
    .pipe($.eslint({ fix: true }))
    .pipe(server.reload({ stream: true, once: true }))
    .pipe($.eslint.format())
    .pipe($.if(!server.active, $.eslint.failAfterError()));
};

function lint() {
  return lintBase("app/scripts/**/*.js").pipe(dest("app/scripts"));
}

function lintTest() {
  return lintBase("test/spec/**/*.js").pipe(dest("test/spec"));
}

function buildHTML() {
  return src("app/views/_04-pages/*.pug")
    .pipe(
      $.pug({
        pretty: true
      })
    )
    .pipe(dest("app"))
    .pipe(server.reload({ stream: true }));
}

function html() {
  return (
    src("app/*.html")
      .pipe($.useref({ searchPath: [".tmp", "app", "."] }))
      .pipe($.if(/\.js$/, $.uglify({ compress: { drop_console: true } })))
      .pipe(
        $.if(
          /\.css$/,
          $.postcss([
            cssnano({ safe: true, autoprefixer: false, discardComments: true })
          ])
        )
      )
      .pipe(
        $.if(
          /\.html$/,
          $.htmlmin({
            collapseWhitespace: false,
            minifyCSS: true,
            minifyJS: { compress: { drop_console: true } },
            processConditionalComments: true,
            removeComments: true,
            removeEmptyAttributes: true,
            removeScriptTypeAttributes: true,
            removeStyleLinkTypeAttributes: true
          })
        )
      )
      // .pipe($.dom(function() {
      //   return this.querySelectorAll('body')[0].setAttribute('data-version', '1.0');
      // }))
      .pipe(dest("dist"))
  );
}

function images() {
  return (
    src(["app/images/**/*", "!app/images/svg/*"], { since: lastRun(images) })
      // .pipe($.imagemin())
      .pipe(dest("dist/images"))
  );
}

function fonts() {
  return src("app/fonts/**/*.{eot,svg,ttf,woff,woff2}").pipe(
    $.if(!isProd, dest(".tmp/fonts"), dest("dist/fonts"))
  );
}

function extras() {
  return src(["app/*", "!app/*.html", "!app/assets/symbol"], {
    dot: true
  }).pipe(dest("dist"));
}

function assets() {
  return src("app/assets/*").pipe(
    $.if(!isProd, dest(".tmp/assets"), dest("dist/assets"))
  );
}

function clean() {
  return del([".tmp", "dist"]);
}

function measureSize() {
  return src("dist/**/*").pipe($.size({ title: "build", gzip: true }));
}

function purifyMyStyle() {
  return src("dist/styles/main.css")
    .pipe($.purifycss(["dist/scripts/**/*.js", "dist/**/*.html"]))
    .pipe(dest("dist/styles"));
}

const build = series(
  clean,
  series(
    buildHTML,
    parallel(
      lint,
      series(parallel(styles, scripts, modernizr), html),
      images,
      fonts,
      extras,
      //  convertSvg,
      assets
    ),
    purifyMyStyle
  ),
  measureSize
);

function startAppServer() {
  server.init({
    notify: false,
    port,
    server: {
      baseDir: [".tmp", "app"],
      routes: {
        "/node_modules": "node_modules"
      }
    }
  });

  watch(["app/*.html", "app/images/**/*", ".tmp/fonts/**/*"]).on(
    "change",
    server.reload
  );

  watch("app/views/**/*.pug", buildHTML);
  watch("app/styles/**/*.scss", styles);
  watch("app/scripts/**/*.js", scripts);
  watch("modernizr.json", modernizr);
  watch("app/fonts/**/*", fonts);
  watch("app/images/svg/*.svg", convertSvg);
  watch("app/assets/**/*", assets);
}

function startTestServer() {
  server.init({
    notify: false,
    port,
    ui: false,
    server: {
      baseDir: "test",
      routes: {
        "/scripts": ".tmp/scripts",
        "/node_modules": "node_modules"
      }
    }
  });

  watch("app/scripts/**/*.js", scripts);
  watch("app/views/**/*.pug", buildHTML);
  watch(["test/spec/**/*.js", "test/**/*.html"]).on("change", server.reload);
  watch("test/spec/**/*.js", lintTest);
}

function startDistServer() {
  server.init({
    notify: false,
    port,
    server: {
      baseDir: "dist",
      routes: {
        "/node_modules": "node_modules"
      }
    }
  });
}

let serve;
if (isDev) {
  serve = series(
    clean,
    parallel(styles, scripts, modernizr, fonts, assets),
    startAppServer
  );
} else if (isTest) {
  serve = series(clean, scripts, startTestServer);
} else if (isProd) {
  serve = series(build, startDistServer);
}

const compiler = series(build, purifyMyStyle, revRename, revUpdateRef);

exports.purify = purifyMyStyle;
exports.convertSvg = convertSvg;
exports.compiler = compiler;
exports.serve = serve;
exports.build = build;
exports.default = build;
