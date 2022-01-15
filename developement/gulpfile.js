const gulp = require("gulp");
const autoprefixer = require("gulp-autoprefixer");
const del = require("del");
const sass = require("gulp-sass")(require("sass"));

const browserSync = require("browser-sync");
const phpConnect = require('gulp-connect-php');

//Php connect
function connectSync() {
    phpConnect.server({
        port: 8000,
        keepalive: true,
        base: "public"
    }, function () {
        browserSync({
            proxy: '127.0.0.1:8000',
        });
    });
}

// BrowserSync Reload
function browserSyncReload(done) {
    browserSync.reload();
    done();
}


// Watch files
function watchPhp() {
    gulp.watch("./**/*.php", gulp.series(browserSyncReload));
}


function buildStyles() {
    cleanStyles();
    return gulp
        .src("./src/styles/**/*.scss")
        .pipe(sass().on("error", sass.logError))
        .pipe(
            autoprefixer({
                cascade: false,
            })
        )
        .pipe(gulp.dest("./public/styles"));
}

function cleanStyles() {
    return del(["./public/styles/**/*.css"])
}

function watchSass() {
    gulp.watch("./src/styles/**/*.scss", gulp.series(buildStyles, browserSyncReload))
}

exports.watch = gulp.parallel([watchPhp, watchSass, connectSync]);

