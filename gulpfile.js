var gulp = require('gulp');
var util = require('gulp-util');
var concat = require("gulp-concat");
var cleanCSS = require('gulp-clean-css');
var less = require('gulp-less');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var watch = require('gulp-watch');
var uglify = require('gulp-uglify');

var production = util.env.production;

gulp.task('script', function(){
    return gulp.src([
            'resources/assets/js/jquery/jquery.js',
            'resources/assets/js/jquery-ui/jquery-ui.js',
            'resources/assets/js/bootstrap/bootstrap.js',
            'resources/assets/js/select2/select2.js',
            'resources/assets/js/simplemde/simplemde.js',
            'resources/assets/js/fileupload/jquery.iframe-transport.js',
            'resources/assets/js/fileupload/jquery.fileupload.js',
            'resources/assets/js/bootstrap-datepicker/bootstrap-datepicker.js',
            'resources/assets/js/bootstrap-datepicker/locales/bootstrap-datepicker.sk.js',
            'resources/assets/js/sh/shCore.js',
            'resources/assets/js/sh/shBrushCpp.js',
            'resources/assets/js/sh/shBrushJava.js',
            'resources/assets/js/*.js',
        ])
        .pipe(production ? util.noop() : sourcemaps.init())
        .pipe(concat('app.js'))
        .pipe(production ? uglify() : util.noop())
        .pipe(production ? util.noop() : sourcemaps.write())
        .pipe(gulp.dest('public/js/'));

});

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