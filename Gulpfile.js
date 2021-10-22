/* eslint-disable no-console */
/* eslint-disable no-undef */

// require node_modules needed
const gulp = require('gulp');
const autoprefixer = require('autoprefixer');
const image = require('gulp-image');
const jshint = require('gulp-jshint');
const postcss = require('gulp-postcss');
const sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');
const cleanCSS = require('gulp-clean-css');
const phpcs = require('gulp-phpcs');
const phpcbf = require('gulp-phpcbf');
const gutil = require('gutil');
const newer = require('gulp-newer');
// const eslint = require( 'gulp-eslint' );
const uglify = require( 'gulp-uglify' );
const rename = require( 'gulp-rename' );
const merge = require('merge-stream');
const purgecss = require("gulp-purgecss");
const plumber = require("gulp-plumber");


// configuration file
var cfg = require("./gulpconfig.json");
var paths = cfg.paths;

// Copy over source files to src folder
gulp.task("update-src", function () {
	// Copy All Bootstrap Files
	var bootstrapjs = gulp
		.src(`${paths.node}/bootstrap/dist/js/**/*.js`)
		.pipe(gulp.dest(`${paths.src}/js/bootstrap4`));

	var bootstrap = gulp
		.src([
			paths.node + "/bootstrap/scss/*/*.scss",
			paths.node + "/bootstrap/scss/*.scss"
		])
		.pipe(gulp.dest(paths.src + "/sass/bootstrap4/"));

	return merge(bootstrapjs, bootstrap);
});

// Run:
// gulp sass
// Compiles SCSS files in CSS
gulp.task("sass", function() {
	var stream = gulp
		.src(paths.src + "/sass/bootstrap4/bootstrap.scss")
		.pipe(
			plumber({
				errorHandler: function(err) {
					console.log(err);
					this.emit("end");
				}
			})
		)
		.pipe(sourcemaps.init({ loadMaps: true }))
		.pipe(sass({ errLogToConsole: true }))
		.pipe(postcss([autoprefixer()]))
		.pipe(sourcemaps.write(undefined, { sourceRoot: null }))
		.pipe(gulp.dest(paths.css));
	return stream;
});

gulp.task("minifycss", function() {
	return gulp
		.src(`${paths.css}/bootstrap.css`)
		.pipe(sourcemaps.init({ loadMaps: true }))
		.pipe(cleanCSS({ compatibility: "*" }))
		.pipe(
			plumber({
				errorHandler: function(err) {
					console.log(err);
					this.emit("end");
				}
			})
		)
		.pipe(rename({ suffix: ".min" }))
		// .pipe(sourcemaps.write("./"))
		.pipe(gulp.dest(paths.css));
});

// /**
//  * PHP via PHP Code Sniffer.
//  */
gulp.task('php', function() {

	return gulp.src(paths.php.src)
	// If not a rebuild, then run tasks on changed files only.
	// .pipe(gulpif(!isRebuild, newer(paths.php.dest)))
	.pipe(phpcs({
		bin: 'vendor/bin/phpcs',
		standard: 'WordPress',
		colors: 1,
		// report: 'summary',
		warningSeverity: 0
	}))
	// Log all problems that were found.
	.pipe(phpcs.reporter('log'))
	.pipe(phpcs.reporter('file', { path:  'src/errors.txt' }))
	.pipe(gulp.dest(paths.php.dest));

});

// /**
//  * PHP via PHP Code Sniffer.
//  */
gulp.task('phpcbf', function() {

	return gulp.src(['./html/**/*.php', './private/**/*.php'], {base:'./'})
	// If not a rebuild, then run tasks on changed files only.
	// .pipe(gulpif(!isRebuild, newer(paths.php.dest)))
	.pipe(phpcbf({
		bin: 'vendor/bin/phpcbf',
		standard: 'WordPress',
		show_progress: 1,
		// colors: 1,
		// report: 'summary',
		warningSeverity: 0
	}))
	// Log all problems that were found.
	.on('error', gutil.log)
	// .pipe(phpcs.reporter('file', { path:  'clean/errors.txt' }))
	.pipe(gulp.dest('./'));

});

// // Optimize images through gulp-image
gulp.task('images', function() {
	return gulp.src(img + '**/*.{jpg,JPG,png}')
	.pipe(newer(img))
	.pipe(image())
	.pipe(gulp.dest(img))
	.pipe(gulp.dest(paths.img.dest));
});

// // JavaScript
gulp.task('javascript', function() {
	return gulp.src(paths.js.src)
	.pipe(jshint())
	.pipe(jshint.reporter('default'))
	// .pipe(gulp.dest(js))
	.pipe(uglify())
	.pipe(gulp.dest(paths.js.dest));
});

gulp.task('purgecss', function () {
	return gulp
		.src(paths.css + "/bootstrap.min.css")
		.pipe(
			purgecss({
				content: [paths.public + "/**/*.php", paths.private + "/**/*.php"],
				whitelist: ['text-white'],
				whitelistPatterns: []
			})
		)
		.pipe(rename({ basename: "theme", suffix: ".min" }))

		.pipe(gulp.dest(paths.css));
});

gulp.task("purgecss-rejected", function () {
	return gulp
		.src(paths.css + "/bootstrap.css")
		.pipe(
			rename({
				suffix: ".rejected"
			})
		)
		.pipe(
			purgecss({
				content: [
					paths.public + "**/*.php",
					paths.private + "**/*.php",
					"!node_modules/",
					"!sass/",
					"!src/",
					"!vendor/"
				],
				rejected: true
			})
		)
		.pipe(gulp.dest(paths.css));
});

// // How to do mulpitle tasks
gulp.task('styles', gulp.series('sass', 'minifycss', 'purgecss'));