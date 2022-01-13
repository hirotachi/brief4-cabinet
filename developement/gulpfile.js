const gulp = require("gulp");
const autoprefixer = require("gulp-autoprefixer");
const sass = require("gulp-sass")(require("sass"));

function buildStyles() {
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
exports.buildStyles = buildStyles;

exports.watch = function () {
    gulp.watch("./src/styles/**/*.scss", buildStyles);
};