
// Require Gulp
var gulp = require('gulp');

// Include plugins
var plugins = require("gulp-load-plugins")({
    pattern: ['gulp-*', 'gulp.*', 'main-bower-files', 'run-sequence'],
    replaceString: /\bgulp[\-.]/
});

// Define the destination folder
var dest = './web/';

// Define the JS folder (i.e. that contains AngularJs file)
var jsFiles = [
    './web/js/*',
    './web/js/controller/*',
    './web/js/directives/*',
    './web/js/services/*',
];

// Define the CSS folder
var cssFiles = [
  './web/css/*'
];

// Tasks
gulp.task('vendor', function (){
    return gulp.src(plugins.mainBowerFiles())
        .pipe(plugins.sourcemaps.init())
        .pipe(plugins.filter('*.js'))
        .pipe(plugins.concat('vendor.js'))
        .pipe(plugins.uglify({mangle: false}).on('error', function(e) { console.log('\x07',e.message); return this.end(); }))
        .pipe(plugins.sourcemaps.write('.'))
        .pipe(gulp.dest(dest + 'js/build'));
});

gulp.task('js', function() {
    return gulp.src(jsFiles)
        .pipe(plugins.sourcemaps.init())
        .pipe(plugins.filter('*.js'))
        .pipe(plugins.concat('main.js'))
        .pipe(plugins.uglify({mangle: false}).on('error', function(e) { console.log('\x07',e.message); return this.end(); }))
        .pipe(plugins.sourcemaps.write('.'))
        .pipe(gulp.dest(dest + 'js/build'));
});



gulp.task('movefonts', function() {
  return gulp.src('./bower_components/bootstrap/fonts/*')
    .pipe(gulp.dest('./web/fonts'));
});

gulp.task('bootstrap:prepareLess', ['movefonts'], function() {
  return gulp.src('./web/less/variables.less')
    .pipe(gulp.dest('./bower_components/bootstrap/less'));
});

gulp.task('less', ['bootstrap:prepareLess'],function() {
    return gulp.src(plugins.mainBowerFiles())
        .pipe(plugins.sourcemaps.init())
        .pipe(plugins.filter('*.less'))
        .pipe(plugins.less().on('error', function(e) { console.log('\x07',e.message); return this.end(); }))
        .pipe(plugins.sourcemaps.write('.'))
        .pipe(gulp.dest('./web/css'));
});


gulp.task('css', function() {
    gulp.src(cssFiles)
        .pipe(plugins.filter('*.css'))
        .pipe(plugins.concat('main.css'))
        .pipe(plugins.minifyCss().on('error', function(e) { console.log('\x07',e.message); return this.end(); }))
        .pipe(gulp.dest(dest + 'css/build'));
});

gulp.task('movecssmap', function(){
    gulp.src('./web/css')
        .pipe(plugins.filter('*.map'))
        .pipe(gulp.dest('./web/css/build'));
});

gulp.task('lesscss', function() {
    plugins.runSequence('less', 'css', 'movecssmap');
});

// Build
gulp.task('build', function() {
    plugins.runSequence('js', 'lesscss');
});

gulp.task('default', ['build']);

// Watch
gulp.task('watch', function() {
    plugins.livereload.listen();
    gulp.watch(jsFiles, ['js']);
});
