'use strict';

var gulp = require('gulp'),
	sass = require('gulp-sass'),
	plumber = require('gulp-plumber'),
	autoprefixer = require('gulp-autoprefixer'),
	sourcemaps = require('gulp-sourcemaps'),
	ts = require('gulp-typescript'),
	notify = require("gulp-notify"),
	through = require('through2');

var PATH = {
    templateSourcePath: './private/templates/start/src/',
    templateBuildPath: './public/assets/',
    stylesheet: { sassFolder: 'scss', cssFolder: 'css' },
    javascript: { typescriptFolder: 'ts', jsFolder: 'js' }
};

var tsPath = PATH.templateSourcePath + PATH.javascript.typescriptFolder,
    jsPath = PATH.templateBuildPath + PATH.javascript.jsFolder,
    scssPath = PATH.templateSourcePath + PATH.stylesheet.sassFolder,
    cssPath = PATH.templateBuildPath + PATH.stylesheet.cssFolder;

var AUTOPREFIXER_BROWSERS = [
	  "Android 2.3",
	  "Android >= 4",
	  "Chrome >= 20",
	  "Firefox >= 24",
	  "Explorer >= 9",
	  "iOS >= 6",
	  "Opera >= 12",
	  "Safari >= 6"
];

var tsProject = ts.createProject(tsPath + '/tsconfig.json');

/*
 * 'styles' task - used to convert scss to css
 */
gulp.task('styles', function () {
    var sassOptions = {
        outputStyle: 'compressed' // shall be compact,expanded,nested,compressed
    };

    var plumberErrorHandler = function (error) {
        console.log(error.message);
        notify(error.message);
        this.emit('end');
    };

    return gulp.src(scssPath + '/*.scss')
			.pipe(plumber({
			    errorHandler: notify.onError({
			        "title": "ERROR",
			        "message": "Error: <%= error.message %>"
			    })
			}))
			.pipe(sourcemaps.init())
			.pipe(sass(sassOptions))
			.pipe(autoprefixer({ browsers: AUTOPREFIXER_BROWSERS }))
			.pipe(sourcemaps.write('./'))
			.pipe(gulp.dest(cssPath));
});

gulp.task('tsccompile', function () {
    return gulp.src([tsPath + '/**/*.ts'])
		        .pipe(plumber(/*{
		            errorHandler: notify.onError({
		                "title": "ERROR",
		                "message": "Error: <%= error.message %>"
		            })
		        }*/))
				.pipe(ts(tsProject))
				.pipe(gulp.dest(jsPath));
});

/*
 * 'watch' task - all watch tasks goes here
 */
gulp.task('watch', function () {
    // Watch Sass files and execute 'styles' task
    gulp.watch(scssPath + '/**/*.scss', ['styles'])
		.on("change", function (event) {
		    console.log('[WATCHER FOR SASS] File ' + event.path.replace(/^.*(\\|\/|\:)/, '') + ' was ' + event.type + ', compiling...');
		});
    ;

    // Watch typescript files and execute 'scripts' task
    gulp.watch(tsPath + '/**/*.ts', ['tsccompile'])
		.on("change", function (event) {
		    console.log('[WATCHER FOR TYPESCRIPT] File ' + event.path.replace(/^.*(\\|\/|\:)/, '') + ' was ' + event.type + ', compiling...');
		});
});

gulp.task('default', ['styles', 'tsccompile']);
