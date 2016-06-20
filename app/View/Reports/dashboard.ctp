  <div class="row">
    <div class="medium-6 columns">
        <h2>My code stats</h2>
        <p>I use <a href="https://wakatime.com" title="WakaTime" rel="nofollow">WakaTime</a>, a time tracking service for developers, to quantify my code contributions to personal and open source projects. The data behind this page comes from the WakaTime API (<a href="https://github.com/chrisvogt/stats/blob/master/app/Controller/Component/WakaTimeComponent.php" title="View code on GitHub"><i class="fa fa-code"></i></a>) and represents my coding habits over the last thirty days.</p>
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

    $.each(data, function(x, datum) {
        // add category data
        categoryData.push({
            name: categories[x],
            y: data[x].y,
            color: data[x].color
        });
        // add language data
        if (data[x].drilldown.data) {
            for (var j = 0; j < data[x].drilldown.data.length; j++) {
                var brightness = 0.2 - (j / data[x].drilldown.data.length) / 5 ;
                languageData.push({
                    name: data[x].drilldown.categories[j],
                    y: data[x].drilldown.data[j],
                    color: Highcharts.Color(data[x].color).brighten(brightness).get()
                });
            }
        }
    });

    <?php echo $chart->render("chart");?>
    <?php echo $langChart->render("chart");?>
</script>
