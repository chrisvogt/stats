<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
App::uses('CrudControllerTrait', 'Crud.Lib');
App::uses('Component', 'Controller', 'File');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
	use CrudControllerTrait;

    /**
     * List of global controller components
     *
     * @var array
     */
	public $components = [
		'RequestHandler',
		'Session',
		'Crud.Crud' => [
			'listeners' => [
				'Crud.Api',
				'Crud.ApiPagination',
				'Crud.ApiQueryLog'
			]
		],
		'Paginator' => ['settings' => ['paramType' => 'querystring', 'limit' => 30]]
	];

    /**
     * beforeFilter() overrides
     *
     * @return void
     */
	public function beforeFilter() {
		Parent::beforeFilter();
	}

    /**
     * Loads data from the Data directory.
     * @return array decoded data
     */
    protected function loadData($filename) {
        $file = new File(APP . 'Data/' . $filename . '.json');
        $data = json_decode($file->read(), true);

        return $data;
    }
}
