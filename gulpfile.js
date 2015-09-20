var gulp = require('gulp');
var frep = require('gulp-frep');
var minifyHtml = require('gulp-compressor');
var hash_src = require("gulp-hash-src");
var htmlReplace = require('gulp-html-replace');
var process = require('child_process');

// variables and conf
var srcPath = ['src/**/*.html', 'src/**/*.php', '!./src/order/temp.php'];
var destDir = 'dist';
var staticParentDir = '/Users/liujb/Dropbox/Code/mis-dev/'
var staticPath = staticParentDir + '/static/';
var minOpts = require(staticPath + 'conf/minify.js').html;
var replaceOpts = require(staticPath + 'conf/replace.js');
var concatOpts = require(staticPath + 'conf/concat.js');
var hashOpts = {
  build_dir: staticParentDir,
  src_path: "./src",
  query_name: 'v',
  hash_len: 12
};

/**
 * 替换html中的js和css的links
 * 同时给这些links加上版本号
 */
var replaceLinksAndHash = function (action) {
  var opts = (action === 'test') ? replaceOpts.test : replaceOpts.deploy;
  return gulp.src(['dist/**/*.php', 'dist/**/*.html'])
    .pipe(frep(opts))
    .pipe(hash_src(hashOpts))
    .pipe(gulp.dest(destDir));
};

gulp.task('htmlBuildAndMinfiy', function () {
  var opts = {};
  concatOpts.forEach(function (item) {
    if (item.tag && item.dest && item.name) opts[item.tag] = '/static/' + item.dest + item.name;
  });

  return gulp.src(srcPath)
    .pipe(htmlReplace(opts))
    .pipe(minifyHtml(minOpts))
    .pipe(gulp.dest(destDir));
});

/**
 * 构建依赖的static项目，并且构建html
 */
var buildDependStaticThenHtml = function (action) {
  if (action != 'test' && action !== 'deploy') return console.log('action must be test or deploy');

  console.log('Starting Build static files, please waitting for a moment...');
  process.exec('cd ' + staticPath + ' && gulp ' + action + '', function (error, stdout, stderr) {
    if (error) return console.log(error);
    console.log('Static files have done.');

    if (action === 'dev') return console.log('Done');

    console.log('Starting build html...');
    process.exec('cd ' + __dirname + ' && gulp htmlBuildAndMinfiy', function (err) {
      if (err) return console.log(err);
      replaceLinksAndHash(action);
      console.log('HTML files have done.');
    });
  });
}

/**
 * 发布到开发环境
 */
gulp.task('dev', function () {
  buildDependStaticThenHtml('dev');
});

/**
 * 发布到测试环境
 */
gulp.task('test', function () {
  buildDependStaticThenHtml('test');
});
gulp.task('default', ['test']);

/**
 * 发布到线上环境
 * 若静态资源未迁移到静态server上，此命令目前不需要执行
 */
gulp.task('deploy', function () {
  buildDependStaticThenHtml('deploy');
});

// 初始化所有gulp
gulp.task('init', function () {
  concole.log('Installing static dependent packages and init static project....');
  console.log('Please waitting... ');
  process.exec('cd ' + staticPath + ' && sh gulpinit.sh', function (error, stdout, stderr) {
    if (!error) {
      concole.log('All static packages installed and init done.');
    }
  });
});
