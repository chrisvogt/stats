<?php
/**
 * Reports Controller
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
	public $components = ['WakaTime.WakaTime'];

	/**
	 * Default action for the app
	 *
	 * @return void
	 */
	public function dashboard() {
		$this->set('data', 'data');
		$this->set('user', $this->WakaTime->currentUser());
	}
}
