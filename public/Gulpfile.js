
var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var jade = require('gulp-jade');
gulp.task('css',function(){

    gulp.src('frontend/assets/sass/module.scss')
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(gulp.dest('frontend/css'));
});

gulp.task('templates', function() {

    gulp.src(['frontend/assets/jade/**/*.jade', '!frontend/assets/jade/master.jade'])
        .pipe(jade({
            pretty: true
        }))
        .pipe(gulp.dest('./'))
});

gulp.task('watch',function(){

    gulp.watch('frontend/assets/sass/**/*.scss',['css']);

    gulp.watch('frontend/assets/jade/**/*.jade',['templates']);
});

gulp.task('default',['watch']);