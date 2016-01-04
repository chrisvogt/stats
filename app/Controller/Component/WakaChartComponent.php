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

use Ghunti\HighchartsPHP\Highchart;
use Ghunti\HighchartsPHP\HighchartJsExpr;

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

    public $mapping = [
        'scripting' => [
            'PHP',
            'JavaScript',
            'Python'
        ],
        'styles' => [
            'SCSS',
            'CSS',
            'LESS'
        ],
        'data' => [
            'YAML',
            'JSON'
        ],
        'markup' => [
            'HTML',
            'Markdown'
        ],
        'other' => [
            'Text',
            'Other'
        ]
    ];

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
		$chart = new Highchart();

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
        $chart->subtitle->text = 'Public projects on GitHub';
        $chart->subtitle->color = '78909C';

        $chart->yAxis->gridLineColor = '#37474F';

        $chart->tooltip->formatter = new HighchartJsExpr(
            "function() { return '<b>'+ this.x +'</b>: ' + this.y + ' hours' +' logged.';}");

		$chart->xAxis->categories = $this->_extractTitles($data);

		$chart->yAxis['min'] = 0;
        $chart->yAxis->title->text = "Hours";

        $chart->series[0] = array(
			'name' => 'Hours',
            'lineColor' => '#b2ff59',
            'lineWidth' => 1.5,
			'data' => $this->_extractStats($data),
	    	'tooltip' => array(
        		'valueDecimals' => 1
    		)
		);

        $chart->series[0]->fillColor->linearGradient->x1 = 0;
        $chart->series[0]->fillColor->linearGradient->y1 = 0;
        $chart->series[0]->fillColor->linearGradient->x2 = 0;
        $chart->series[0]->fillColor->linearGradient->y2 = 1;
        $chart->series[0]->fillColor->stops = array(
            array(
                0,
                '#03A9F4'
            ),
            array(
                1,
                "rgba(33,33,33,1)"
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
	public function buildLanguageChart()
{		$chart = new Highchart();

		$chart->chart = [
            "renderTo" => "chartLanguages",
            "type"     => "pie",
            "plotBackgroundColor" => null,
            "backgroundColor"     => null,
            "style"    => ["fontFamily" => "Merriweather, serif"]
        ];

        $chart->title = array(
            'text' => 'Filetypes edited',
            'style' => [
                "fontFamily" => "Quicksand, sanf-serif",
                "color"      => "#4527a0"
            ]
        );
        $chart->subtitle->text = 'Source: <a href="https://wakatime.com/">WakaTime</a>';
		$chart->credits->enabled = false;

        $chart->plotOptions = [
            "pie" => [
                "shadow" => false,
                "center" => ['50%', '50%']
            ]
        ];

        $chart->tooltip->formatter = new HighchartJsExpr(
            "function() { return '<b>'+ this.point.name +'</b> – ' + this.y + '%';}");

        $chart->series[] = array(
            'name' => "Categories",
            'data' => new HighchartJsExpr("categoryData"),
            'size' => "60%",
            'dataLabels' => array(
                'formatter' => new HighchartJsExpr("function() {
            return this.y > 5 ? this.point.name : null; }"),
                'color' => 'white',
                'distance' => - 30,
                'style' => ['textShadow' => '0 0 6px #212121, 0 0 3px #212121']
            )
        );
        $chart->series[1]->name = "Languages";
        $chart->series[1]->data = new HighchartJsExpr("languageData");
        $chart->series[1]->innerSize = "80%";
        $chart->series[1]->dataLabels->color = '#484848';
        $chart->series[1]->dataLabels->formatter = new HighchartJsExpr(
            "function() {
            return this.y > .5 ? '<b>'+ this.point.name +':</b> '+ this.y +'%'  : null;}");

		return $chart;
	}

    public function getLanguageData($data) {
        $stats       = $this->_extractLanguageStats($data);
        $mapped_data = $this->_buildLanguageData($stats);

        $chartData = new Highchart();

        $i = 0;
        foreach ($mapped_data as $category => $list) {
            $chartData[$i] = [
                "y" => array_sum($list),
                "color" => new HighchartJsExpr("colors[" . $i . "]"),
                "drilldown" => [
                    "name"       => $category,
                    "categories" => array_keys($list),
                    "data"       => array_values($list),
                    "color"      => new HighchartJsExpr("colors[" . $i . "]")
                ]
            ];
            $i++;
        }
        unset($i);

        return $chartData;
    }

/**
 * Maps language stats to chart data.
 *
 * @param array
 * @return array
 */
    protected function _buildLanguageData($stats) {
        $total = 0;

        foreach ($stats as $stat) {
            $total += $stat[1];
        }

        $mapped = [];
        foreach ($this->mapping as $category => $list) {
            $mapped[$category] = [];
            foreach ($stats as $stat) {
                if (in_array($stat[0], $list)) {
                    $mapped[$category][$stat[0]] = round($stat[1] / $total * 100, 1);
                }
            }
        }

        return $mapped;
    }

/**
 * Extract and return language statistics from WakaTime data.
 *
 * @param array
 * @return array
 */
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
		$list = $this->_buildList($langs);
        $filtered = $this->_filterList($list);

		return $filtered;
	}

    protected function _buildList($langs) {
        $list = [];
        foreach ($langs as $k => $v) {
            $list[] = [$k, $v];
        }
        return $list;
    }

    protected function _filterList($list) {
        $list = array_values(array_filter($list, array($this, '_filterLangs')));
        return $list;
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

/**
 * Filters out unwanted items.
 *
 * @param array
 * @return boolean
 */
    protected function _filterLangs($lang) {
        $unwanted = [
            'Image (png)',
            'Bash'
        ];
        $found = in_array($lang[0], $unwanted);
        return($found) ? false : true;
    }

}
