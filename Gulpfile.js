
var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');

gulp.task('css',function(){

    gulp.src('frontend/assets/sass/module.scss')
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(gulp.dest('frontend/css'));
});

gulp.task('watch',function(){

    gulp.watch('frontend/assets/sass/**/*.scss',['css']);
});

gulp.task('default',['watch']);