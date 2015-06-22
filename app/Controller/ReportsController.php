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
 * @package		app.Controller.ReportsController
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class ReportsController extends AppController {

	/**
	 * List of controller components
	 *
	 * @var array
	 */
	public $components = ['WakaTime.WakaTime', 'WakaChart', 'RequestHandler'];

	/**
	 * Default action for the app
	 *
	 * @return void
	 */
	public function dashboard() {
		$this->set('userData', $this->_cacheHandler('currentUser'));
		$chart7Days = $this->_cacheHandler('dailySummary', array(date('m/d/Y', strtotime('-7 days')), date('m/d/Y')));
		$this->set('chart', $this->WakaChart->totalHoursChart($chart7Days['data']));
		$this->set('totalHours', $this->_cacheHandler('getHoursLoggedForLast7Days'));
		$this->response->header('Access-Control-Allow-Origin','*');
		$this->set('_serialize', array('totalHours'));
	}

	public function _cacheHandler($request, $args = null) {
		if (Cache::read($request)) {
			$response = Cache::read($request);
		} else {
			$a = func_get_args($args);
			if (isset($a[1])) {
				$response = call_user_func_array(array($this->WakaTime, $request), $a[1]);
			} else {
				$response = $this->WakaTime->$request();
			}
			Cache::write($request, $response);
		}
		return $response;
	}
}
