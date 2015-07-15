<?php
/**
 * Off Canvas View Layout
 * for stats.chrisvogt.me
 *
 * Generates the developer stats reports using the WakaTime API.
 *
 * PHP ≥5.4
 *
 * CHRISVOGT.me : Developer stats (http://stats.chrisvogt.me)
 * Copyright (c) Chris Vogt (http://www.chrisvogt.me)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) 2015 Chris Vogt (http://www.chrisvogt.me)
 * @link          http://stats.chrisvogt.me Developer Stats, CHRISVOGT.me
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?><!DOCTYPE html>
<html lang="en">
<head>
	<?php echo $this->Html->charset(); ?>
	<!--
	brought to you by...
 ██████╗ ██╗██╗   ██╗ ██████╗
██╔════╝███║██║   ██║██╔═████╗
██║     ╚██║██║   ██║██║██╔██║
██║      ██║╚██╗ ██╔╝████╔╝██║
╚██████╗ ██║ ╚████╔╝ ╚██████╔╝
 ╚═════╝ ╚═╝  ╚═══╝   ╚═════╝
	chrisvogt.me | @c1v0
	-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php echo Configure::read('Site.title'); ?></title>

	<?php
		echo $this->Html->meta(['name' => 'description', 'content' => 'Chris Vogt\'s Open Source Stats']) . "\n";
		echo "\t" . $this->Html->meta(['name' => 'author', 'content' => 'Chris Vogt']) . "\n";
		echo "\t" . $this->Html->meta(['name' => 'robots', 'content' => 'index, follow']) . "\n";
		echo "\t" . $this->Html->meta(['property' => 'og:image', 'content' => $this->Html->Url('/img/screenshot.png', true)]) . "\n";
		echo "\t" . $this->Html->meta(['property' => 'og:description', 'content' => 'A public report of my realtime open source stats and contributions. ']) . "\n";
		echo "\t" . $this->Html->meta(['property' => 'og:author', 'content' => 'Chris Vogt']) . "\n";
		echo "\t" . $this->Html->meta(['name' => 'twitter:card', 'content' => 'summary_large_image']) . "\n";
		echo "\t" . $this->Html->meta(['name' => 'twitter:site', 'content' => 'http://stats.chrisvogt.me']) . "\n";
		echo "\t" . $this->Html->meta(['name' => 'twitter:creator', 'content' => '@C1V0']) . "\n";
		echo "\t" . $this->Html->meta(['name' => 'twitter:title', 'content' => 'Chris Vogt\'s Open Source Stats']) . "\n";
		echo "\t" . $this->Html->meta(['name' => 'twitter:description', 'content' => 'A public report of my realtime open source stats and contributions. ']) . "\n";
		echo "\t" . $this->Html->meta(['name' => 'twitter:image', 'content' => $this->Html->Url('/img/screenshot.png', true)]) . "\n";
		echo "\t" . $this->Html->meta(['name' => 'theme-color', 'content' => '#5D5096']) . "\n";
	?>
	<?php
		echo $this->Html->meta('icon') . "\n";

		echo "\t" . $this->Html->css('http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css') . "\n";
		echo "\t" . $this->Html->css('/components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css') . "\n";
		echo "\t" . $this->Html->css('https://cdn.rawgit.com/chrisvogt/projects/develop/css/projects.css') . "\n";
		echo "\t" . $this->Html->css('statsboard') . "\n";
		echo "\t" . $this->Html->css('//cdnjs.cloudflare.com/ajax/libs/github-fork-ribbon-css/0.1.1/gh-fork-ribbon.min.css') . "\n";
		echo "\t" . $this->Html->css('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css') . "\n";

		echo "\t" . $this->Html->script('/components/jquery/dist/jquery.min.js') . "\n";
		echo "\t" . $this->Html->script('http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js') . "\n";
		echo "\t" . $this->Html->script('/components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') . "\n";
		echo "\t" . $this->Html->script('/components/jasny-bootstrap/js/offcanvas.js') . "\n";

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<?php echo $this->Html->css('//cdnjs.cloudflare.com/ajax/libs/github-fork-ribbon-css/0.1.1/gh-fork-ribbon.ie.min.css') . "\n"; ?>
	<![endif]-->
</head>
<body>
	<?php echo $this->element('offcanvas'); ?>
	<?php echo $this->element('navbar-top'); ?>

	<?php echo $this->element('jumbotron'); ?>

	<div class="container">
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<?php echo $this->element('footer'); ?>
		<?php echo $this->fetch('scriptBottom'); ?>
		<?php echo $this->Js->writeBuffer(); ?>
	</div>
</body>
</html>
