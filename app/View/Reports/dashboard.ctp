<?php
/**
 * Template: Stats dashboard
 */ ?>
		<div class="row">
			<div class="col-sm-12">
				<p class="lead"><i class="fa fa-twitter"></i><a href="https://twitter.com/c1v0" title="Chris Vogt on Twitter">@<?php echo $userData['data']['full_name']; ?></a> has logged <strong><?php echo $totalHours; ?> hours</strong> in the last 7 days.</p>
			</div>
		</div>

		<div class="row">
			<div id="chart7Days" class="col-md-6 chart"></div>
			<div id="chartLanguages" class="col-md-6 chart"></div>
		</div>

		<?php $chart->printScripts(); ?>

		<script type="text/javascript">
		    <?php echo $chart->render("chart");?>
		    <?php echo $langChart->render("chart");?>
		</script>
