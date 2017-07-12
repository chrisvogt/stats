<?php
/**
 * cakephp-wakatime
 *
 * WakaTime API consumer plugin for CakePHP.
 *
 * Licensed under the MIT license.
 * For full copyright and license information, please see the LICENSE file.
 *
 * @copyright       (c) 2015 Chris Vogt <mail@chrisvogt.me>
 * @link                    https://github.com/chrisvogt/cakephp-wakatime
 * @license             http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Component', 'Controller');
App::uses('HttpSocket', 'Network/Http');

/**
 * WakaTime Component class
 *
 * @link https://github.com/chrisvogt/cakephp-wakatime
 */
class WakaTimeComponent extends Component
{
    /**
     * Base URL for the API call.
     *
     * @var string
     */
    protected $baseUrl = 'https://wakatime.com/api/v1/users/current/';

    /**
     * Response object container.
     *
     * @var array|object
     */
    private $response;

    /**
     * Holds the WakaTime API Key.
     *
     * @var string
     */
    private $apiKey = '';

    /**
     * WakaTime component configuration
     *
     * @var array
     */
    public $settings;

    /**
     * Class constructor
     *
     * @param ComponentCollection $collection the component collection for this request
     * @param array $settings passed to the component from the controller
     * @return void
     */
    function __construct(ComponentCollection $collection, $settings = array()) {
        $this->settings = $settings;
        parent::__construct($collection, $settings);
    }

    /**
     * Overrides initialize
     *
     * Overrides applied before the controller’s beforeFilter method.
     *
     * @param Controller $controller
     * @return boolean|void
     */
    public function initialize(Controller $controller) {
        parent::initialize($controller);
        $settings = $this->settings;
        $this->setApiKey($settings);

        return true;
    }

    /**
     * Checks for an API key:
     *   * Passed to the component
     *   * OR in /Config/wakatime.php
     *
     * @param array $settings
     * @throws InvalidArgumentException
     * @return void
     */
    public function setApiKey($settings) {
        if (!empty($settings['api_key'])) {
            $this->apiKey = $settings['api_key'];
        } elseif (Configure::check('wakatime.api_key')) {
            $this->apiKey = Configure::read('wakatime.api_key');
        } else {
            throw new InvalidArgumentException('WakaTime requires an active API key.');
        }
    }

    /**
     * Makes the API call.
     *
     * Examples:
     * ```
     * makeRequest('summaries', ['start' => $start, 'end' => $end]);
     * makeRequest('stats/last_30_days');
     * ```
     *
     * @param string $resource
     * @param null $params
     * @return array
     */
    protected function makeRequest($resource, $params = null) {
        $HttpSocket = new HttpSocket(['ssl_verify_host' => false]);
        $params['api_key'] = $this->apiKey;

        $query = $this->buildQuery($resource, $params);
        $results = $HttpSocket->get($query);

        if ($results->code == 401) {
            throw new Exception('Received an UNAUTHORIZED response from WakaTime. Is your API key set and valid?');
        } elseif ($results->code == 404) {
            throw new Exception('Received a NOT FOUND response from WakaTime. Is the request endpoint valid?');
        } elseif ($results->code == 200) {
            return json_decode($results->body, true);
        }
    }

    /**
     * Builds the query string.
     *
     * @param string $resource
     * @param null $params
     * @return string
     */
    public function buildQuery($resource, $params = null) {
        return $this->baseUrl . $resource . '?' . http_build_query($params, '', '&', PHP_QUERY_RFC1738);
    }

    /**
     * See: https://wakatime.com/developers#summaries
     *
     * @param integer $start date
     * @param integer $end date
     * @return array
     */
    public function getDailySummaries($start, $end) {
        return $this->makeRequest('summaries', [
            'start' => date('Y-m-d', $start),
            'end'   => date('Y-m-d', $end)
        ]);
    }

    /**
     * Calculates the total seconds spent coding.
     *
     * @param array $data
     * @return integer
     */
    public function calculateTotalSeconds($data) {
        $count = 0;

        foreach ($data as $d) {
            $s = $d['grand_total']['total_seconds'];
            if (!empty($s)) {
                $count += $s;
            }
        }

        return $count;
    }

    /**
     * Convert number of seconds into hours and minutes.
     *
     * @param integer $seconds
     * @return array
     */
    public function convertSecondsToWords($seconds) {
        $string = '';

        $hours = floor($seconds / (60 * 60));
        $divisor_for_minutes = $seconds % (60 * 60);
        $minutes = floor($divisor_for_minutes / 60);

        $times = array(
            "hours" => (int) $hours,
            "minutes" => (int) $minutes
        );

        foreach($times as $k => $v) {
            if (!empty($v)) {
                $string .= "{$v} {$k}, ";
            }
        }

        return substr_replace($string, "", -2);
    }
}
