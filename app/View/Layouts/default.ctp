<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Recent coding stats for Chris Vogt — Web Developer in San Francisco.');
?><!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset() . "\n"; ?>
    <?php echo $this->Html->meta(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0']) . "\n";?>
<!--
/**
███████╗████████╗ █████╗ ████████╗███████╗
██╔════╝╚══██╔══╝██╔══██╗╚══██╔══╝██╔════╝
███████╗   ██║   ███████║   ██║   ███████╗
╚════██║   ██║   ██╔══██║   ██║   ╚════██║
███████║   ██║   ██║  ██║   ██║   ███████║
╚══════╝   ╚═╝   ╚═╝  ╚═╝   ╚═╝   ╚══════╝
                           by chrisvogt.me
-->
	<title><?php echo $title_for_layout; ?> — CHRISVOGT.me</title>

<?php
  echo "\t" . $this->Html->meta(['name' => 'description', 'content' => $cakeDescription]) . "\n";
  echo "\t" . $this->Html->meta(['name' => 'author', 'content' => 'Chris Vogt']) . "\n";
  echo "\t" . $this->Html->meta(['name' => 'robots', 'content' => 'index, follow']) . "\n";
  echo "\t" . $this->Html->meta(['property' => 'og:title', 'content' => 'stats.chrisvogt.me']) . "\n";
  echo "\t" . $this->Html->meta(['property' => 'og:image', 'content' => $this->Html->Url('/img/screenshot.png', true)]) . "\n";
  echo "\t" . $this->Html->meta(['property' => 'og:description', 'content' => $cakeDescription]) . "\n";
  echo "\t" . $this->Html->meta(['property' => 'og:author', 'content' => 'Chris Vogt']) . "\n";
  echo "\t" . $this->Html->meta(['name' => 'twitter:card', 'content' => 'summary_large_image']) . "\n";
  echo "\t" . $this->Html->meta(['name' => 'twitter:site', 'content' => 'https://stats.chrisvogt.me']) . "\n";
  echo "\t" . $this->Html->meta(['name' => 'twitter:creator', 'content' => '@c1v0']) . "\n";
  echo "\t" . $this->Html->meta(['name' => 'twitter:title', 'content' => 'stats.chrisvogt.me']) . "\n";
  echo "\t" . $this->Html->meta(['name' => 'twitter:description', 'content' => $cakeDescription]) . "\n";
  echo "\t" . $this->Html->meta(['name' => 'twitter:image', 'content' => $this->Html->Url('/img/screenshot.png', true)]) . "\n";
  echo "\t" . $this->Html->meta(['name' => 'theme-color', 'content' => '#0a2364']) . "\n";
?>

    <link rel="shortcut icon" href="https://cdn.rawgit.com/chrisvogt/chrisvogt.me/master/img/favicon.ico">
    <link rel="apple-touch-icon" href="https://cdn.rawgit.com/chrisvogt/chrisvogt.me/master/img/favicon-57.png">
    <link rel="apple-touch-icon" sizes="76x76" href="https://cdn.rawgit.com/chrisvogt/chrisvogt.me/master/img/favicon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="https://cdn.rawgit.com/chrisvogt/chrisvogt.me/master/img/favicon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="https://cdn.rawgit.com/chrisvogt/chrisvogt.me/master/img/favicon-152.png">

    <?php
  	echo $this->Html->meta('icon');

    $css_app = Configure::read('debug') > 0 ? '/fos/css/app' : 'app.min';
    echo $this->Html->css([
        $css_app,
        'font-awesome.min'
    ]);

    $this->Html->script([
        'foundation.min.js',
        'https://cdn.rawgit.com/chrisvogt/www/7cc19758b045b891db4526f2e87b52fa7ff09ae3/app/scripts/HttpSocket.js',
        'https://cdn.rawgit.com/chrisvogt/www/7cc19758b045b891db4526f2e87b52fa7ff09ae3/app/scripts/app.js',
        'https://cdn.rawgit.com/chrisvogt/www/7cc19758b045b891db4526f2e87b52fa7ff09ae3/app/scripts/social.jquery.js'
    ], ['block' => 'scriptBottom']);

  	echo $this->fetch('meta');
  	echo $this->fetch('css');
  	echo $this->fetch('script');
    ?>
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <?php echo $this->element('navigation/top'); ?>
    <div id="header-chart" class="row fullWidth">
        <div id="chart7Days" class="fullWidth chart"></div>
    </div>
    <div id="ticker" class="row text-center fullWidth">
        <p class="lead">
            <strong><?php echo $totalTimeInWords; ?></strong> logged, <br class="show-for-small-only">last thirty days
        </p>
    </div>
	<div id="content">
        <?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
	</div>
    <section id="promote">
        <div class="row">
            <div class="medium-8 columns">
                <p>View my code on GitHub to learn more.</p>
            </div>
            <div class="medium-4 columns">
                <a href="https://github.com/chrisvogt?tab=contributions&amp;period=monthly" title="Chris Vogt on GitHub" class="button expand hvr-float-shadow"><i class="fa fa-github"></i> <em>chrisvogt</em> on GitHub</a>
            </div>
        </div>
    </section>

    <section id="social">
      <div class="row">
        <div class="large-12 columns">
          <nav id="links">
            <ul class="inline-list">
                <!-- AJAX: Social Links -->
            </ul>
          </nav>
        </div>
      </div>
    </section>
    <footer>
      <div class="row">
        <div class="small-6 columns">
            <p>
                <i class="fa fa-code"></i> with <i class="fa fa-heart"></i> by <i class="fa fa-twitter"></i>
                <a href="https://twitter.com/c1v0" title="@c1v0 on Twitter">@c1v0</a>
            </p>
        </div>
        <div class="small-6 columns">
          <ul class="inline-list right">
            <?php foreach ($topNavigation['right'] as $item): ?>
                <?php echo $this->Element('navigation/item', ['item' => $item]); ?>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </footer>
    <?php echo $this->fetch('scriptBottom'); ?>
    <?php echo $this->Js->writeBuffer(); ?>
    <script>
      WebFontConfig = {
        google: { families: [ 'Quicksand::latin', 'Merriweather:300,300italic:latin' ] }
      };
      (function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
          '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
      })(); </script>
    <?php if (env('ANALYTICS_ID')): ?>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', <?php echo env('ANALYTICS_ID'); ?>, 'auto', {'allowLinker': true});
      ga('require', 'linker');
      ga('linker:autoLink', ['www.chrisvogt.me'] );
      ga('send', 'pageview');
    </script>
    <?php endif; ?>
</body>
</html>
