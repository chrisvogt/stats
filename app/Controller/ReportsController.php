<?php
/**
 * Reports Controller for Statsboard.
 *
 * Generates the developer stats reports using the WakaTime API.
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
App::uses('AppController', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package     app.Controller.ReportsController
 * @link        http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class ReportsController extends AppController
{
    /**
     * List of controller components
     *
     * @var array
     */
    public $components = ['WakaTime', 'WakaChart', 'RequestHandler'];

    /**
     * Stats dashboard
     */
    public function dashboard() {
        $dailySummaries = Cache::remember('summaries', function() {
            return $this->WakaTime->getDailySummaries(strtotime('-30 days'), strtotime('now'));
        }, 'resource');
        $data = [
            'title_for_layout' => 'Recent coding stats',
            'topNavigation' => $this->loadData('top-navigation'),
            'chart' => $this->WakaChart->totalHoursChart($dailySummaries['data']),
            'langChart' => $this->WakaChart->buildLanguageChart(),
            'chartData' => $this->WakaChart->getLanguageData($dailySummaries['data']),
            'totalTimeInWords' => $this->getTime($dailySummaries['data']),
            '_serialize' => array('totalTimeInWords')
        ];

        $this->set($data);
        $this->response->header('Access-Control-Allow-Origin','*');
    }

    /**
     * The total time, in words
     *
     * @param array $data
     * @return string
     */
    private function getTime($data) {
        $seconds = $this->WakaTime->calculateTotalSeconds($data);
        $words   = $this->WakaTime->convertSecondsToWords($seconds);

        return $words;
    }

}
