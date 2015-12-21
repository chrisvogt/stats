<?php
/**
 * Template: dashboard (home)
 *
 * @author Chris Vogt <mail@chrisvogt.me>
 */ ?>
  <div class="row">
    <div class="medium-6 columns">
        <h2>My coding habits</h2>
        <p>May '15 I began using <a href="https://wakatime.com" title="WakaTime - time tracking for developers" rel="nofollow">WakaTime</a>, a time tracking service for developers, to track my time spent coding for open source projects. The charts on this page are generated using data from the WakaTime API (<a href="https://github.com/chrisvogt/stats/blob/master/app/Controller/Component/WakaTimeComponent.php" title="View code on GitHub"><i class="fa fa-code"></i></a>).</p>
    </div>
    <div class="medium-6 columns">
      <div id="chartLanguages" class="chart"></div>
    </div>
  </div>

<?php $chart->printScripts(); ?>

<script type="text/javascript">
    <?php echo $chart->render("chart");?>
    <?php echo $langChart->render("chart");?>
</script>
