<?php
/**
 * Template: Footer
 */ ?>

	<div id="footer" class="row">
		<div class="col-sm-4">
			<small>Made with <i class="fa fa-heart heart"></i> by <a href="https://twitter.com/c1v0" title="@C1V0 on Twitter" class="hvr-grow-rotate">@C1V0.</a></small>
		</div>
		<div class="col-sm-4 text-center">
			<?php echo $this->Html->link(
				$this->Html->image('wakatime-name.png', ['alt' => 'Tracked with WakaTime', 'width' => '128']),
				'http://www.wakatime.com/',
				['target' => '_blank', 'escape' => false]
			); ?>
		</div>
		<div class="col-sm-4 text-right">
			<?php echo $this->Html->link(
				$this->Html->image('cake.power.png', ['alt' => 'Made with CakePHP']),
				'http://www.cakephp.org/',
				['target' => '_blank', 'escape' => false]
			); ?>
		</div>
	</div>
