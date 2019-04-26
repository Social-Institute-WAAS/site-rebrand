
const { src, dest, parallel, series, watch} = require('gulp');
const pug = require('gulp-pug');
const sass = require('gulp-sass');
const minifyCSS = require('gulp-csso');
const concat = require('gulp-concat');
const babel = require('gulp-babel');
const autoprefixer = require('gulp-autoprefixer');
const terser = require('gulp-terser');
// const inject = require('gulp-inject'); // Add the inject task
const browserSync = require('browser-sync');
const server = browserSync.create();
 
const condition = process.env.NODE_ENV === "development" ? { sourcemaps: true } : { sourcemaps: false };

sass.compiler = require('node-sass');

    function serve(done){
        server.init({
            server: {
                baseDir: './app/'
            }
        });
        done();
    }

    function reload(done) {
        server.reload();
        done();
    }

    function html() {
        return src(['src/views/*.pug','src/views/_04-pages/*.pug'])
<<<<<<< 5c4c4dbc4a61384d34697eb525027d0dea020875
            .pipe(pug({
                pretty:true
            }))
=======
            .pipe(pug({pretty: true}))
>>>>>>> Theme building by template referente twentynineteen
            .pipe(dest('app'))
    }

    function css() {
        return src('src/styles/*.scss', condition)
            .pipe(sass())
            .pipe(autoprefixer({
                browsers: ['last 2 versions'],
                cascade: false
            }))
            .pipe(minifyCSS())
            .pipe(concat('app.min.css'))
            .pipe(dest('app/css', condition ))
    }

    function js() {
        return src('src/scripts/*.js', condition)
            .pipe(babel())
            .pipe(terser())
            .pipe(concat('app.min.js'))
            .pipe(dest('app/js', condition))
    }

    function vendor() {
        return src([
            // 'node_modules/jquery/dist/jquery.js',
            // 'node_modules/popper.js/dist/popper.js',
            // 'node_modules/bootstrap/dist/js/bootstrap.js',
            'src/scripts/vendor/hammer.min.js'
            ], condition)
            .pipe(babel())
            // .pipe(terser())
            .pipe(concat('vendor.min.js'))
            .pipe(dest('app/js', condition))
    }

    function watcher() {
        watch('src/views/**/*.pug', series(html, reload));
        watch('src/styles/*.scss', series(css, reload));
        watch('src/scripts/*.js', series(js, reload));
    }

    function getAssets() {
        return src('src/assets/**/*')
            .pipe(dest('app/assets'))
    }

    function build(done) {
        html(); 
        css();
        js();
        getAssets();
        done();
    }
  
  
  exports.js = js;
  exports.vendor = vendor;
  exports.css = css;
  //task("css", css); //Another way to do
  exports.html = html;
  exports.getAssets = getAssets;

  exports.watcher = parallel(serve, watcher);
  exports.default = parallel(html, css, js, getAssets);
  exports.build = build;