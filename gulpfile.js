var gulp = require('gulp');
var util = require('gulp-util');
var concat = require("gulp-concat");
var cleanCSS = require('gulp-clean-css');
var less = require('gulp-less');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var watch = require('gulp-watch');

var production = util.env.production;

gulp.task('style', function() {
    return gulp.src(["resources/assets/less/style.less"])
        .pipe(sourcemaps.init())
        .pipe(less())
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(concat("style.css"))
        .pipe(production ? cleanCSS() : util.noop())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest("public/css"));
});


gulp.task('watch', function(){
    gulp.watch('resources/assets/less/*', ['style']);
    gulp.watch('resources/assets/less/*/*', ['style']);
    // Other watchers
})


gulp.task('default', [
    'style'
]);