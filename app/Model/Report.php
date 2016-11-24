<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppModel', 'Model');

/**
 * Report model
 *
 * @package       app.Model.Report
 */
class Report extends AppModel
{
    /**
     * Fetches model data only, no joins
     *
     * @var int
     */
	public $recursive = -1;

    /**
     * Behaviors used by this model
     *
     * @var array
     */
	public $actsAs = ['Containable'];

    /**
     * This model does not use a database table
     *
     * @var boolean
     */
	public $useTable = false;

    /**
     * Social links getter method
     *
     * @return array
     */
    public function getSocial() {
        return $this->social;
    }
}
