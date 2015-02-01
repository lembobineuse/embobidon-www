var gulp = require('gulp'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    minifycss = require('gulp-minify-css'),
    autoprefixer = require('gulp-autoprefixer'),

    web_dir = '../htdocs/don',
    scripts = [
        web_dir + '/js/embobidon/image-wall.js',
        web_dir + '/js/main.js'
    ],
    styles = [
        web_dir + '/css/main.css'
    ]
;

gulp.task('default', ['styles', 'scripts']);

gulp.task('scripts', function()
{
    return gulp.src(scripts)
        .pipe(concat('all.js'))
        // This will minify and rename to foo.min.js
        .pipe(uglify())
        .pipe(rename({ extname: '.min.js' }))
        .pipe(gulp.dest(web_dir + '/js/'))
    ;
});

gulp.task('styles', function ()
{
    return gulp.src(styles)
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
        .pipe(concat('all.css'))
        .pipe(minifycss())
        .pipe(rename({ extname: '.min.css'} ))
        .pipe(gulp.dest(web_dir + '/css/'))
    ;
});
