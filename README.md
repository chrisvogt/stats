[![Build status](https://img.shields.io/travis/chrisvogt/stats.svg?branch=master&style=flat-square)](https://travis-ci.org/chrisvogt/stats)
[![GitHub release](https://img.shields.io/github/release/chrisvogt/stats.svg?style=flat-square)](https://github.com/chrisvogt/stats/releases)
[![GitHub license](https://img.shields.io/github/license/chrisvogt/stats.svg?style=flat-square)](https://github.com/chrisvogt/stats/blob/master/LICENSE)

# stats.chrisvogt.me

Personal coding habits report built using CakePHP and data from the [WakaTime](https://wakatime.com) API.

View it live at [stats.chrisvogt.me](https://stats.chrisvogt.me).

### How to use

**1.** Clone the repository.

    git clone https://github.com/chrisvogt/stats

**2.** Install node, Bower, and Composer dependencies.

    npm install && bower install && composer install

**3.** Configure the `.env` file.

    Give `DEBUG` a value greater than 0.

**4.** Use grunt to preview or build.

    grunt  # 'watches' for changes to the scss/js

    grunt publish  # runs golive tasks - minify, concat, etc.

**5.** Serve the webroot directory using the built-in PHP web server

    php -t webroot -S localhost:9000

### Screenshot

[![Code stats on CHRISVOGT.me](fos/images/screenshot.png)](https://stats.chrisvogt.me)

### License

[MIT](LICENSE) © [Chris Vogt](https://www.chrisvogt.me).

### Built with

<p align="left">
    <img src="https://cdn.rawgit.com/chrisvogt/wowchar-info/master/webroot/img/cake-logo-smaller.png" alt="CakePHP" height="48">
    <img src="http://upload.wikimedia.org/wikipedia/en/9/9e/JQuery_logo.svg" alt="jQuery" height="48">
    <img src="http://bower.io/img/bower-logo.svg" alt="Bower.js" height="48">
    <img src="http://gruntjs.com/img/grunt-logo-no-wordmark.svg" alt="grunt.js" height="48">
    <img src="https://upload.wikimedia.org/wikipedia/commons/1/1b/CSS3_and_HTML5_badges.svg" alt="HTML5 &amp; CSS3" height="48">
    <img src="https://cdn.rawgit.com/mathamoz/ionic-builder/master/public/images/why-the-yeti.svg" alt="Zurb Foundation 5" height="48">
</p>
