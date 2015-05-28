<div id="footer" class="row">
	<div class="col-sm-4">
		<p><label class="label label-primary">Made with ❤ by <a href="https://twitter.com/c1v0" title="@C1V0 on Twitter">@C1V0.</label></p>
	</div>
	<div class="col-sm-4 text-center">
		<?php echo $this->Html->link(
			$this->Html->image('wakatime-name.png', ['alt' => 'Tracked with WakaTime', 'border' => '0', 'width' => '128px']),
			'http://www.wakatime.com/',
			['target' => '_blank', 'escape' => false]
		); ?>
	</div>
	<div class="col-sm-4 text-right">
		<?php echo $this->Html->link(
			$this->Html->image('cake.power.png', ['alt' => 'Made with CakePHP', 'border' => '0']),
			'http://www.cakephp.org/',
			['target' => '_blank', 'escape' => false]
		); ?>
	</div>
</div>
