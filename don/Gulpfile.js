var gulp = require('gulp'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    minifycss = require('gulp-minify-css'),
    autoprefixer = require('gulp-autoprefixer'),
    replace = require('gulp-replace'),

    fs = require('fs'),

    scripts = [
        '../htdocs/don/js/src/image-wall.js',
        '../htdocs/don/js/src/main.js'
    ],
    styles = [
        '../htdocs/don/css/src/main.css'
    ],
    VERSION_RX = /^return (\d+);/m,
    VERSION
;


function readVersion ()
{
    var subject = fs.readFileSync('app/config/assets_version.php', {encoding: 'utf-8'}),
        version = VERSION_RX.exec(subject)[1]
    ;
    if (!version) {
        throw new Error('Could not read assets version.');
    }
    return parseInt(version, 10);
}
VERSION = readVersion();

gulp.task('default', ['watch', 'styles', 'scripts']);
gulp.task('build', ['styles', 'scripts']);
gulp.task('deploy', ['bump', 'build']);

gulp.task('watch', function ()
{
    gulp.watch('../htdocs/don/js/src/**', ['scripts']);
    gulp.watch('../htdocs/don/css/src/**', ['styles']);
});

gulp.task('scripts', function ()
{
    console.log('running scripts');
    return gulp.src(scripts)
        .pipe(concat('all.js'))
        // This will minify and rename to foo.min.js
        .pipe(uglify())
        .pipe(rename({ extname: '_v' + VERSION + '.min.js' }))
        .pipe(gulp.dest('../htdocs/don/js/dist'))
    ;
});

gulp.task('styles', function ()
{
    console.log('running styles');
    return gulp.src(styles)
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
        .pipe(concat('all.css'))
        .pipe(minifycss())
        .pipe(rename({ extname: '_v' + VERSION + '.min.css'} ))
        .pipe(gulp.dest('../htdocs/don/css/dist'))
    ;
});

gulp.task('bump', function ()
{
    VERSION += 1;
    return gulp.src('app/config/assets_version.php')
        .pipe(replace(/^return (\d+);/m, function () {
            return 'return ' + VERSION + ';';
        })).pipe(gulp.dest('replace_test'))
    ;
});
