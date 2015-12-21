<?php
/**
 * WakaChart component Statsboard.
 *
 * Bridges WakaTime and Highcharts.
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
App::uses('Component', 'Controller');
App::import(
	'Vendor',
	'Highchart',
	array('file' => 'ghunti' . DS . 'highcharts-php' . DS . 'src' . DS . 'Highchart.php')
);

use Ghunti\HighchartsPHP;

/**
 * WakaChart Component class
 *
 * Bridges mabasic/wakatime-php-api and HighCharts.
 *
 * @link https://github.com/chrisvogt/cakephp-wakatime
 * @link https://github.com/mabasic/wakatime-php-api
 */
class WakaChartComponent extends Component {

	/**
	 * Holds the WakaTime object
	 *
	 * @var object
	 */
	protected $WakaTime;

	/**
	 * Class constructor
	 *
	 * @param ComponentCollection $collection the component collection for this request
	 * @param array $settings passed to the component from the controller
	 * @return void
	 */
	function __construct(ComponentCollection $collection, $settings = array()) {
		parent::__construct($collection, $settings);
	}

	/**
	 * Hooks onto controller initialization
	 *
	 * Overrides applied before the controller’s beforeFilter method.
	 *
	 * @param Controller $controller
	 * @return boolean|void
	 */
	public function initialize(Controller $controller) {
		parent::initialize($controller);
		return true;
	}

/**
 * Hours logged by day chart
 *
 * Generates an hours logged by day chart for the last 30 days.
 *
 * @param array $data
 * @return Ghunti\HighchartsPHP\Highchart
 */
	public function totalHoursChart($data) {
		$chart = new Ghunti\HighchartsPHP\Highchart();

		$chart->chart = array(
			'renderTo' 	=> 'chart7Days',
			'type' 		=> 'areaspline',
            'backgroundColor' => null
		);
        $chart->chart->style = ["fontFamily" => "Quicksand, sans-serif"];
		$chart->credits->enabled = false;
		$chart->title = array(
            'text' => 'Time spent coding, last 30 days',
            'style' => [
                'fontFamily' => 'Quicksand, sanf-serif',
                'color' => '#fafafa'
            ]
        );
        $chart->subtitle->text = 'Open source contributions';
        $chart->subtitle->color = '78909C';

        $chart->yAxis->gridLineColor = '#37474F';

        $chart->tooltip->formatter = new Ghunti\HighchartsPHP\HighchartJsExpr(
            "function() { return '<b>'+ this.x +'</b>: ' + this.y + ' hours' +' logged.';}");

		$chart->xAxis->categories = $this->_extractTitles($data);

		$chart->yAxis['min'] = 0;
        $chart->yAxis->title->text = "Hours";

        $chart->series[0] = array(
			'name' => 'Hours',
            'fillColor' => '#03A9F4',
            'lineColor' => '#b2ff59',
			'data' => $this->_extractStats($data),
	    	'tooltip' => array(
        		'valueDecimals' => 1
    		)
		);

        $chart->legend->enabled = false;

		return $chart;
	}

	/**
	 * This function will take:
	 * 	- the result from Daily Summary()
	 *
	 * see: https://cdn.rawgit.com/chrisvogt/8ddba818f7c312b58cc2/raw/f3330d0b9b0369cf121af0baa63ec9cea4cf5d0e/summaries.json
	 */
	public function getLanguageChart($data) {
		$chart = new Ghunti\HighchartsPHP\Highchart();

		$chart->chart->renderTo = "chartLanguages";
		$chart->credits->enabled = false;
		$chart->chart->plotBackgroundColor = null;
		$chart->chart->backgroundColor = null;
		$chart->chart->style = ["fontFamily" => "Merriweather, serif"];
        $chart->title = array(
            'text' => 'Language breakdown',
            'style' => ["fontFamily" => "Quicksand, sanf-serif"]
        );
		$chart->title->style->color = "#4527a0";
		$chart->subtitle->text = 'Filetypes edited, last 30 days';
		$chart->tooltip->formatter = new Ghunti\HighchartsPHP\HighchartJsExpr(
		    "function() {
		    return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(1) +' %';}");
		$chart->plotOptions->pie->allowPointSelect = 1;
		$chart->plotOptions->pie->cursor = "pointer";
		$chart->plotOptions->pie->dataLabels->enabled = 1;
		$chart->plotOptions->pie->dataLabels->color = "#484848";
        $chart->plotOptions->pie->dataLabels->style->textShadow = false;
		$chart->plotOptions->pie->dataLabels->connectorColor = "#cecece";
		$chart->plotOptions->pie->dataLabels->formatter = new Ghunti\HighchartsPHP\HighchartJsExpr(
		    "function() {
		    return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(1) +' %'; }");
		$chart->series[] = array(
		    'type' => "pie",
		    'name' => "Languages",
		    'data' => $this->_extractLanguageStats($data)
		);

		return $chart;
	}

	protected function _extractLanguageStats($data) {
		$langs = [];
		foreach ($data as $event) {
			foreach ($event['languages'] as $lang) {
				if (!isset($langs[$lang['name']])) {
					$langs[$lang['name']] = $lang['total_seconds'];
				} else {
					$langs[$lang['name']] += $lang['total_seconds'];
				}
			}
		}
		$l = [];
		foreach ($langs as $k => $v) {
			$l[] = [$k, $v];
		}
		return $l;
	}

/**
 * Extracts titles from WakaTime data
 *
 * @param Ghunti\HighchartsPHP\Highchart $data
 * @return array
 */
	protected function _extractTitles($data) {
		$titles = array();

		foreach ($data as $day => $val) {
			$titles[] = $val['range']['date'];
		}

		return $titles;
	}

/**
 * Extracts values from the WakaTime data
 *
 * @param Ghunti\HighchartsPHP\Highchart
 * @return array
 */
	protected function _extractStats($data) {
		$stats = array();

		foreach ($data as $day => $val) {
			$date = $val['range']['date'];
			$minutes = number_format($val['grand_total']['minutes'] / 60, 2);
			$stats[] = $val['grand_total']['hours'] + $minutes;
		}

		return $stats;
	}

}
