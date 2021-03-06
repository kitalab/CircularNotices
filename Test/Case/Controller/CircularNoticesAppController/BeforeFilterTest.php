<?php
/**
 * CircularNoticesAppController::beforeFilter()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');
App::uses('CircularNoticesAppController', 'CircularNotices.Controller');

/**
 * CircularNoticesAppController::beforeFilter()のテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\Case\Controller\CircularNoticesAppController
 */
class CircularNoticesAppControllerBeforeFilterTest extends NetCommonsControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.circular_notices.circular_notice_choice',
		'plugin.circular_notices.circular_notice_content',
		'plugin.circular_notices.circular_notice_frame_setting',
		'plugin.circular_notices.circular_notice_setting',
		'plugin.circular_notices.circular_notice_target_user',
		'plugin.user_attributes.user_attribute_layout',
		'plugin.frames.frame',
		'plugin.blocks.block',
	);

/**
 * Plugin name
 *
 * @var string
 */
	public $plugin = 'circular_notices';

/**
 * beforeFilterメソッド用DataProvider
 *
 * #### 戻り値
 *  - data: テストデータ
 *  - assert: テストの期待値
 *  - exception: Exception
 *
 * @return array
 */
	public function dataBeforeFilter() {
		$results = array();
		$results[1] = array(
			'urlOptions' => array(
				'frame_id' => 13,
			),
			'assert' => array(
				'method' => 'assertEmpty',
			),
		);

		return $results;
	}

/**
 * beforeFilterメソッドテスト
 *
 * @param array $urlOptions URLオプション
 * @param array $assert テストの期待値
 * @param string|null $exception Exception
 * @param string $return testActionの実行後の結果
 * @dataProvider dataBeforeFilter
 * @return void
 */
	public function testBeforeFilter($urlOptions, $assert, $exception = null, $return = 'view') {
		//テスト実施
		$url = Hash::merge(array(
			'plugin' => $this->plugin,
			'controller' => $this->_controller,
			'action' => 'index',
		), $urlOptions);
		$this->_testGetAction($url, $assert, $exception, $return);
	}
}
