const gulp = require("gulp");
const autoprefixer = require("gulp-autoprefixer");
const del = require("del");
const sass = require("gulp-sass")(require("sass"));

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

exports.buildStyles = buildStyles;

exports.watch = function () {
    buildStyles();
    gulp.watch("./src/styles/**/*.scss", buildStyles);
};