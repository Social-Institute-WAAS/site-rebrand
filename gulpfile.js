
const { src, dest, parallel, watch} = require('gulp');
const pug = require('gulp-pug');
const sass = require('gulp-sass');
const minifyCSS = require('gulp-csso');
const concat = require('gulp-concat');

sass.compiler = require('node-sass');


    function html() {
        return src('src/templates/*.pug')
            .pipe(pug())
            .pipe(dest('dist/html'))
    }

    function css() {
        return src('src/templates/*.scss')
            .pipe(sass())
            .pipe(minifyCSS())
            .pipe(dest('dist/css'))
    }

    function js() {
        return src('src/javascript/*.js', { sourcemaps: true })
            .pipe(concat('app.min.js'))
            .pipe(dest('dist/js', { sourcemaps: true }))
    }
  
  exports.js = js;
  exports.css = css;
  exports.html = html;

  exports.default = parallel(html, css, js);