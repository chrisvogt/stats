<?php
/**
 * Template: dashboard (home)
 *
 * @author Chris Vogt <mail@chrisvogt.me>
 */ ?>
  <div class="row">
    <div class="medium-6 columns">
        <h2>Coding habits</h2>
        <p>May '15 I began using <a href="https://wakatime.com" title="WakaTime - time tracking for developers" rel="nofollow">WakaTime</a>, a time tracking service for developers, to track time spent coding for open source projects. The data behind this page comes from the WakaTime API (<a href="https://github.com/chrisvogt/stats/blob/master/app/Controller/Component/WakaTimeComponent.php" title="View code on GitHub"><i class="fa fa-code"></i></a>).</p>
    </div>
    <div class="medium-6 columns">
      <div id="chartLanguages" class="chart"></div>
    </div>
  </div>

<?php $chart->printScripts(); ?>

<script>
    var colors = Highcharts.getOptions().colors,
        categories = ['scripting', 'styles', 'data', 'markup', 'other'],
        name = 'Filetype categories',
        data = <?php echo $chartData->renderOptions(); ?>;

    // Build the data arrays
    var categoryData = [];
    var languageData = [];

    for (var i = 0; i < data.length; i++) {
        // add category data
        categoryData.push({
            name: categories[i],
            y: data[i].y,
            color: data[i].color
        });
        // add language data
        for (var j = 0; j < data[i].drilldown.data.length; j++) {
            var brightness = 0.2 - (j / data[i].drilldown.data.length) / 5 ;
            languageData.push({
                name: data[i].drilldown.categories[j],
                y: data[i].drilldown.data[j],
                color: Highcharts.Color(data[i].color).brighten(brightness).get()
            });
        }
    }

    <?php echo $chart->render("chart");?>
    <?php echo $langChart->render("chart");?>
</script>
