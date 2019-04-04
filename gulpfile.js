
const { src, dest, parallel, watch} = require('gulp');
const pug = require('gulp-pug');
const sass = require('gulp-sass');
const minifyCSS = require('gulp-csso');
const concat = require('gulp-concat');
const babel = require('gulp-babel');
const autoprefixer = require('gulp-autoprefixer');
const inject = require('gulp-inject'); // Add the inject task
const browserSync = require('browser-sync');
const reload =  browserSync.reload;

var ENV = "PROD";
var condition = ENV == "DEV" ? { sourcemaps: true } : { sourcemaps: false };

sass.compiler = require('node-sass');


    function html() {
        return src(['src/views/*.pug','src/views/_04-pages/*.pug'])
            .pipe(pug())
            .pipe(dest('app'))
            .pipe(reload({stream: true}))
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
            .pipe(reload({stream: true}))
    }

    function js() {
        return src('src/scripts/*.js', condition)
            .pipe(babel())
            .pipe(concat('app.min.js'))
            .pipe(dest('app/js', condition))
            .pipe(reload({stream: true}))
    }

    function watcher() {
        browserSync({server: './app'});
        watch('src/views/*.pug', html);
        watch('src/styles/*.scss', css);
        watch('src/scripts/*.js', js);
    }

    function getAssets() {
        return src('assets/*')
            .pipe(dest('app/assets'))
    }

    function build(cb) {
        ENV = "PROD";
        html(); 
        css();
        js();
        cb();
    }
  
  exports.watcher = watcher;
  exports.js = js;
  exports.css = css;
  exports.html = html;
  exports.getAssets = getAssets;

 

  exports.default = parallel(html, css, js);
  exports.build = build;