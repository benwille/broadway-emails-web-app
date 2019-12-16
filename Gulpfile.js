var themename = 'emails';

var gulp = require('gulp'),
	// Prepare and optimize code etc
	autoprefixer = require('autoprefixer'),
	// browserSync = require('browser-sync').create(),
	image = require('gulp-image'),
	jshint = require('gulp-jshint'),
	postcss = require('gulp-postcss'),
	sass = require('gulp-sass'),
	sourcemaps = require('gulp-sourcemaps'),
	cleanCSS = require('gulp-clean-css'),
	phpcs = require('gulp-phpcs'),
	phpcbf = require('gulp-phpcbf'),
	gutil = require('gutil'),
	// Only work with new or updated files
	newer = require('gulp-newer'),
	eslint = require( 'gulp-eslint' ),
	uglify = require( 'gulp-uglify' ),
	rename = require( 'gulp-rename' )

	// Name of working theme folder
	// root = '../',
	// public = root + 'public/',
	// css = public + 'css/dev/',
	// js = public + 'js/',
	// img = public + 'images/';
	// // languages = root + 'languages/';

const paths = {
	php: {
		src: [ 'dev/**/*.php', '!../dev/**/*.*', '!../includes/**/*.*', '!../dist/**/*.*'],
		dest: 'clean/'
	},
	css: {
		src: [ 'dev/html/stylesheets/*.css'],
		dest: 'clean/html/stylesheets/'
	},
	js: {
		src: [ 'dev/html/js/*.js'],
		dest: 'clean/html/js/'
	},
	img: {
		src: [ 'dev/html/images/' ],
		dest: 'clean/html/images/'
	}
};

const source = {
	css: {
		src: 'public/stylesheets/*.css',
		dest: 'public/stylesheets/'
	}
};

// Minify CSS and Autoprefixer
gulp.task('css', function() {
	return gulp.src(paths.css.src)
	// .pipe(sourcemaps.init())
	// .pipe(sass({
	// 	outputStyle: 'expanded',
	// 	indentType: 'tab',
	// 	indentWidth: '1'
	// }).on('error', sass.logError))
	.pipe(postcss([
		autoprefixer('last 2 versions', '> 1%')
	]))
	.pipe(gulp.dest(paths.css.dest))
	.pipe(cleanCSS({compatibility: 'ie8'}))
	.pipe(rename({
		suffix: ".min"
	}))
	// .pipe(sourcemaps.write(css + 'maps'))
	.pipe(gulp.dest(paths.css.dest));
});

gulp.task('css-minify', function() {
	return gulp.src(source.css.src)

	pipe(postcss([
		autoprefixer('last 2 versions', '> 1%')
	]))
	.pipe(gulp.dest(source.css.dest))
	.pipe(cleanCSS({compatibility: 'ie8'}))
	.pipe(rename({
		suffix: ".min"
	}))
	.pipe(gulp.dest(source.css.dest));

});

// How to do mulpitle tasks
// gulp.task('css',['css-minify', 'css-prefix']);

/**
 * PHP via PHP Code Sniffer.
 */
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
	.pipe(phpcs.reporter('file', { path:  'clean/errors.txt' }))
	.pipe(gulp.dest(paths.php.dest));

});

// Optimize images through gulp-image
gulp.task('images', function() {
	return gulp.src(img + '**/*.{jpg,JPG,png}')
	.pipe(newer(img))
	.pipe(image())
	.pipe(gulp.dest(img))
	.pipe(gulp.dest(paths.img.dest));
});

// JavaScript
gulp.task('javascript', function() {
	return gulp.src(paths.js.src)
	.pipe(jshint())
	.pipe(jshint.reporter('default'))
	// .pipe(gulp.dest(js))
	.pipe(uglify())
	.pipe(gulp.dest(paths.js.dest));
});


// Watch everything
gulp.task('watch', function() {
	browserSync.init({
		open: 'external',
		proxy: 'http://localhost/wordpress/',
		port: 8080
	});
	gulp.watch([root + '**/*.css', root + '**/*.scss' ], ['css']);
	gulp.watch(js + '**/*.js', ['javascript']);
	gulp.watch(img + 'RAW/**/*.{jpg,JPG,png}', ['images']);
	// gulp.watch(root + '**/*').on('change', browserSync.reload);
});


// Default task (runs at initiation: gulp --verbose)
gulp.task('default', ['watch']);
