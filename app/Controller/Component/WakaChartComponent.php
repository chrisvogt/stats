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
 * Generates an hours logged by day chart for the last 7 days.
 *
 * @param array $data
 * @return Ghunti\HighchartsPHP\Highchart
 */
	public function totalHoursChart($data) {
		$chart = new Ghunti\HighchartsPHP\Highchart();
		$chart->chart = array(
			'renderTo' => 'chart7Days', // div ID where to render chart
			'type' => 'spline',
		);
		$chart->title = array('text' => 'Hours logged by day');
		$chart->subtitle->text = 'Open source contributions';
		$chart->xAxis->categories = $this->_extractTitles($data);
		$chart->yAxis['min'] = 0;
		$chart->series[] = array('name' => 'Day', 'data' => $this->_extractStats($data));

		return $chart;
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
			$titles[] = $val['range']['date_human'];
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
