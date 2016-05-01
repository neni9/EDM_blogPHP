var gulp = require('gulp'),
    sass = require('gulp-sass'),
    minify = require('gulp-minify-css'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename');

var path = {
    'resources': {
        'sass': './resources/assets/sass',
        'js': './resources/assets/js'
    },
    'public': {
        'css': './public/assets/css',
        'js': './public/assets/js'
    },
    'sass': './resources/assets/sass/**/*.scss',
    'js': './resources/assets/js/**/*.js',
    'views': './resources/views/**/*.php'
};

gulp.task('task_app_sass', function () {
    return gulp.src(path.resources.sass + '/app.scss')
        .pipe(sass({
            onError: console.error.bind(console, 'SASS ERROR')
        }))
        .pipe(minify())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(path.public.css))
});

gulp.task('js_app', function () {
    return gulp.src(path.resources.js + '/app.js')
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(path.public.js))
});

gulp.task('watch', function () {
    gulp.watch(path.sass, ['task_app_sass']);
    gulp.watch(path.js, ['js_app']);
});

gulp.task('default', ['watch']);
