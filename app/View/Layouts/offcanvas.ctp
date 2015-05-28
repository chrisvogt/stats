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
?><!DOCTYPE html lang="en">
<html>
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

	<title>
		<?php echo Configure::read('Site.title'); ?>
	</title>

	<?php
		echo $this->Html->meta(['name' => 'description', 'content' => 'Chris Vogt\'s Open Source Stats']);
		echo $this->Html->meta(['name' => 'author', 'content' => 'Chris Vogt']);
		echo $this->Html->meta(['name' => 'robots', 'content' => 'index, follow']);
		echo $this->Html->meta(['property' => 'og:image', 'content' => $this->Html->Url('/img/screenshot.png', true)]);
		echo $this->Html->meta(['property' => 'og:description', 'content' => 'A public report of my realtime open source stats and contributions. ']);
		echo $this->Html->meta(['property' => 'og:author', 'content' => 'Chris Vogt']);
		echo $this->Html->meta(['name' => 'twitter:card', 'content' => 'summary_large_image']);
		echo $this->Html->meta(['name' => 'twitter:site', 'content' => 'http://stats.chrisvogt.me']);
		echo $this->Html->meta(['name' => 'twitter:creator', 'content' => '@C1V0']);
		echo $this->Html->meta(['name' => 'twitter:title', 'content' => 'Chris Vogt\'s Open Source Stats']);
		echo $this->Html->meta(['name' => 'twitter:description', 'content' => 'A public report of my realtime open source stats and contributions. ']);
		echo $this->Html->meta(['name' => 'twitter:image', 'content' => $this->Html->Url('/img/screenshot.png', true)]);
	?>

	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css');
		echo $this->Html->css('../components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css');
		echo $this->Html->css('https://raw.githubusercontent.com/chrisvogt/chrisvogt.github.io/develop/css/sandbox.css');
		echo $this->Html->css('statsboard');

		echo $this->Html->script('../components/jquery/dist/jquery.min.js');
		echo $this->Html->script('http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js');
		echo $this->Html->script('../components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js');
		echo $this->Html->script('../components/jasny-bootstrap/js/offcanvas.js');

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
	<?php echo $this->element('offcanvas'); ?>
	<?php echo $this->element('navbar-top'); ?>

	<?php echo $this->element('jumbotron'); ?>
	<?php echo $this->element('social'); ?>

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
