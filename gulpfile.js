var gulp = require('gulp');
var gutil = require('gulp-util');
var notifier = require('node-notifier');
var concat = require('gulp-concat');
var less = require('gulp-less');
var minifyCss = require('gulp-minify-css');
var sourcemaps = require('gulp-sourcemaps');
var uglify = require('gulp-uglify');
var watch = require('gulp-watch');

var notify = function (path) {
    notifier.notify({title: 'File changed', message: path});
};

gulp.task('build', function () {
    gulp.src([
            './node_modules/jquery/dist/jquery.min.js',
            './node_modules/bootstrap/dist/js/bootstrap.min.js',
            './node_modules/select2/dist/js/select2.full.min.js',
            './node_modules/moment/min/moment.min.js',
            './node_modules/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
            './resources/assets/js/app.js',
            './resources/assets/js/util.js'
        ])
        .pipe(concat('app.js'))
        //.pipe(uglify())
        .pipe(gulp.dest('./public/js'));
});

gulp.task('less', function () {
    gulp.src([
            './node_modules/bootstrap/less/bootstrap.less',
            './node_modules/select2/dist/css/select2.css',
            './node_modules/select2-bootstrap-css/select2-bootstrap.min.css',
            './node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
            './node_modules/font-awesome/css/font-awesome.min.css',
            './resources/assets/less/**/*.less'
        ])
        .pipe(sourcemaps.init())
        .pipe(less())
        .pipe(concat('app.css'))
        .pipe(minifyCss({compatibility: 'ie8'}))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('./public/css'));
    gulp.src('./node_modules/bootstrap/fonts/*.*')
        .pipe(gulp.dest('./public/fonts'))
    gulp.src('./node_modules/font-awesome/fonts/*.*')
        .pipe(gulp.dest('./public/fonts'))
});

gulp.task('default', ['build', 'less', 'watch']);

gulp.task('watch', function () {
    gulp.watch('./resources/assets/less/**/*.less', ['less']).on('change', function (path) {
        console.log(path.path);
    });
    gulp.watch('./resources/assets/js/**/*.js', ['build']).on('change', function (path) {
        console.log(path.path);
    });
});