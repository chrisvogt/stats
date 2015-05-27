<div class="row">
	<div class="col-sm-12">
		<p class="lead"><?php echo $userData['data']['full_name']; ?> has logged <strong><?php echo $totalHours; ?> hours</strong> in the last 7 days.</p>
	</div>
</div>

<div id="chart7Days"></div>

<?php $chart->printScripts(); ?>

<script type="text/javascript">
    <?php echo $chart->render("chart");?>
</script>
