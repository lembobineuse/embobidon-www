var gulp = require('gulp'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    minifycss = require('gulp-minify-css'),
    autoprefixer = require('gulp-autoprefixer'),

    scripts = [
        '../htdocs/don/js/src/image-wall.js',
        '../htdocs/don/js/src/main.js'
    ],
    styles = [
        '../htdocs/don/css/src/main.css'
    ]
;

gulp.task('default', ['watch', 'styles', 'scripts']);

gulp.task('watch', function ()
{
    gulp.watch('../htdocs/don/js/src/**', ['scripts']);
    gulp.watch('../htdocs/don/css/src/**', ['styles']);
});

gulp.task('scripts', function ()
{
    return gulp.src(scripts)
        .pipe(concat('all.js'))
        // This will minify and rename to foo.min.js
        .pipe(uglify())
        .pipe(rename({ extname: '.min.js' }))
        .pipe(gulp.dest('../htdocs/don/js/dist'))
    ;
});

gulp.task('styles', function ()
{
    return gulp.src(styles)
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
        .pipe(concat('all.css'))
        .pipe(minifycss())
        .pipe(rename({ extname: '.min.css'} ))
        .pipe(gulp.dest('../htdocs/don/css/dist'))
    ;
});
