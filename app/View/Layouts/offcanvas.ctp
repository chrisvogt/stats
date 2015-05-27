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
		echo $this->Html->meta('icon');

		echo $this->Html->css('http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css');
		echo $this->Html->css('../components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css');
		echo $this->Html->css('https://raw.githubusercontent.com/chrisvogt/chrisvogt.github.io/develop/css/sandbox.css');

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
		<div id="footer" class="row">
			<div class="col-sm-12">
				<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', ['alt' => 'Made with CakePHP', 'border' => '0']),
					'http://www.cakephp.org/',
					['target' => '_blank', 'escape' => false]
				); ?>
			</div>
		</div>
		<?php echo $this->fetch('scriptBottom'); ?>
		<?php echo $this->Js->writeBuffer(); ?>
	</div>
</body>
</html>
