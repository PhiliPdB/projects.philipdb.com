import gulp from 'gulp';
import browserSync from 'browser-sync';
import pngquant from 'imagemin-pngquant';
import del from 'del';

// For handling js imports
import browserify from 'browserify';
import source from 'vinyl-source-stream';
import buffer from 'vinyl-buffer';
import glob from 'glob';
import eventStream from 'event-stream';

// Load gulp plugins
import gulpLoadPlugins from 'gulp-load-plugins';
const $ = gulpLoadPlugins({
	rename: {
		'gulp-connect-php': 'phpConnect'
	}
});

// Es6 uglify
import uglifyjs from "uglify-es";
import composer from "gulp-uglify/composer";

const minify = composer(uglifyjs, console);

const paths = {
	styles: {
		src: 'src/scss/**/*.scss',
		dest: 'build/css/'
	},
	scripts: {
		src: 'src/js/**/*.js',
		dest: 'build/js/'
	},
	images: {
		src: 'src/{images,favicons}/**/*.{jpg,jpeg,png}',
		dest: 'build/'
	},
	html: {
		src: 'src/**/*.{php,html}',
		watch: ['src/*.php', 'src/components/**/*.php', 'src/php/**/*.php'],
		dest: 'build/'
	}
};
const liveReloadFiles = [
	'build/css/**/*.css',
	'build/js/**/*.js',
	'build/images/**/*.{png,jpg,jpeg}',
	'build/components/**/*.php',
	'build/**/index.php'
];

// Start the local servers
export const serve = gulp.parallel(createPhpServers, startBrowserSync);

// Serve & watch
export default gulp.parallel(serve, watch);

// Watch files for changes
export function watch() {
	gulp.watch(paths.styles.src,  build_scss);
	gulp.watch(paths.scripts.src, gulp.series(eslint, build_js));
	gulp.watch(paths.images.src,  minify_images);
	gulp.watch(paths.html.watch,  build_html);
}

// Start the server
export function createPhpServers() {
	// PHP server (will be proxied)
	$.phpConnect.server({
		base: './build/',
		hostname: '0.0.0.0',
		port: 6000
	});

	// Another server for phpMyAdmin, since connect-php doesn't support multiple bases
	$.phpConnect.server({
		base: './phpmyadmin',
		open: false,
		hostname: '0.0.0.0',
		port: 1337
	});
}

export function startBrowserSync() {
	browserSync({
		files: liveReloadFiles,
		proxy: 'localhost:6000',
		port: 8080,
		open: false,
		ui: {
			port: 3001,
			weinre: {
				port: 8000
			}
		}
	}, (err) => {
		if (err)
			console.log(err);
		else
			console.log('BrowserSync is ready.');
	});
}

// Build all
export const build = gulp.parallel(
	build_html,
	build_scss,
	build_js,
	minify_images,
	copy_files
);

function copy_files() {
	// Copy other required files to build if changed
	gulp.src('src/fonts/**.*')
		.pipe($.changed('build/fonts'))
		.pipe(gulp.dest('build/fonts'));

	gulp.src('src/favicons/**.{json,xml,ico}')
		.pipe($.changed('build/favicons'))
		.pipe(gulp.dest('build/favicons'));

	gulp.src('src/robots.txt')
		.pipe($.changed('build/'))
		.pipe(gulp.dest('build/'));

	return Promise.resolve("Copied files");
}

// HTML/php stuff
export function build_html() {
	return gulp.src(paths.html.src)
		.pipe($.changed(paths.html.dest))
		.pipe($.rename((path) => {
			if (path.dirname === '.' && path.extname === '.php' && path.basename !== 'index') {
				path.dirname = path.basename;
				path.basename = 'index';
			}
		}))
		.pipe(gulp.dest(paths.html.dest));
}

// scss stuff
export function build_scss() {
	return gulp.src(paths.styles.src)
		.pipe($.sass().on('error', $.sass.logError))
		.pipe($.autoprefixer())
		// Only minify when we are in production
		.pipe($.if(process.env.NODE_ENV === "production", $.cssnano()))
		.pipe(gulp.dest(paths.styles.dest));
}

// JS stuff
export function eslint() {
	return gulp.src(paths.scripts.src)
		.pipe($.eslint('.eslintrc'))
		.pipe($.eslint.format());
}

export function build_js(done) {
	const debug = !(process.env.NODE_ENV === "production");

	glob(paths.scripts.src, (error, files) => {
		if (error) done(error);

		const tasks = files.map((entry) => {
			if (!debug) {
				return browserify({
					entries: [entry],
					standalone: "app",
					debug: false
				})
					.bundle()
					.pipe(source(entry.replace("src/js/", "")))
					.pipe(buffer())
					.pipe(minify())
					.pipe(gulp.dest(paths.scripts.dest))
			}

			return browserify({
				entries: [entry],
				standalone: "app",
				debug: true
			})
				.bundle()
				.pipe(source(entry.replace("src/js/", "")))
				.pipe(gulp.dest(paths.scripts.dest));
		});
		eventStream.merge(tasks).on('end', done);
	});
}

// Images
export function minify_images() {
	return gulp.src(paths.images.src)
		.pipe($.changed(paths.images.dest))
		.pipe($.imagemin({
			progressive: true,
			use: [pngquant()]
		}))
		.pipe(gulp.dest(paths.images.dest));
}

// MISC
export const rebuild = gulp.series(clear_build, build);

export function clear_build()  {
	return del('build');
}
