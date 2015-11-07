<?php
/**
 * Template: Stats dashboard
 */ ?>
    <div class="row">
    	<div class="col-sm-12">
    		<p class="lead"><i class="fa fa-twitter"></i><a href="https://twitter.com/c1v0" title="Chris Vogt on Twitter">@c1v0</a> has logged <strong><?php echo $totalTimeInWords; ?></strong> working on open source projects over the last 30 days.</p>
    	</div>
    </div>

    <div class="row">
    	<div id="chart7Days" class="col-md-12 chart"></div>
    </div>

    <div class="row">
    	<div id="chartLanguages" class="col-md-12 chart"></div>
    </div>

    <?php $chart->printScripts(); ?>

    <script type="text/javascript">
        <?php echo $chart->render("chart");?>
        <?php echo $langChart->render("chart");?>
    </script>
