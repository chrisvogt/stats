<?php
App::uses('ComponentCollection', 'Controller');
App::uses('Component', 'Controller');
App::uses('WakaTimeComponent', 'Controller/Component');

/**
 * WakaTimeComponent Test Case
 *
 */
class WakaTimeComponentTest extends CakeTestCase {

    /**
     * setUp method
     *
     * @return void
     */
	public function setUp() {
		parent::setUp();
		$Collection = new ComponentCollection();
		$this->WakaTime = new WakaTimeComponent($Collection);
	}

    /**
     * tearDown method
     *
     * @return void
     */
	public function tearDown() {
		unset($this->WakaTime);

		parent::tearDown();
	}

    /**
     * testSetApiKey method
     *
     * @return void
     */
	public function testSetApiKey() {
		$this->markTestIncomplete('testSetApiKey not implemented.');
	}

    /**
     * testGetDailySummaries method
     *
     * @return void
     */
	public function testGetDailySummaries() {
		$this->markTestIncomplete('testGetDailySummaries not implemented.');
	}

    /**
     * Test calculating the total seconds from a summary data array.
     *
     * @return void
     */
	public function testCalculateTotalTime() {
		$data = [
			['grand_total' => ['total_seconds' => 7200]],
			['grand_total' => ['total_seconds' => 3600]],
			['grand_total' => ['total_seconds' => 1800]]
		];
		$result = $this->WakaTime->calculateTotalSeconds($data);
		$this->assertEquals(12600, $result);
	}

    /**
     * Test converting seconds (int) to words in "hours, minutes" form.
     *
     * @return void
     */
	public function testConvertSecondsToWords() {
		$expected = "3 hours, 30 minutes";
		$result = $this->WakaTime->convertSecondsToWords(12600);
		$this->assertEquals($expected, $result);
	}

    /**
     * Test building the query path.
     */
    public function testBuildQuery() {
        $expected = "https://wakatime.com/api/v1/users/current/summaries?start=11%2F05%2F2015&end=11%2F06%2F2015";
        $result = $this->WakaTime->buildQuery('summaries', ['start' => '11/05/2015', 'end' => '11/06/2015']);
        $this->assertEquals($expected, $result);
    }
}
