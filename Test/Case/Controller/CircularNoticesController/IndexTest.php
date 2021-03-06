<?php
/**
 * CircularNoticesController::index()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');

/**
 * CircularNoticesController::index()のテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\Case\Controller\CircularNoticesController
 */
class CircularNoticesControllerIndexTest extends NetCommonsControllerTestCase {

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
 * Controller name
 *
 * @var string
 */
	protected $_controller = 'circular_notices';

/**
 * テストDataの取得
 *
 * @return array
 */
	private function __getData() {
		$frameId = '6';
		$data = array(
			'action' => 'index',
			'frame_id' => $frameId,
		);
		return $data;
	}

/**
 * indexアクションのテスト(ログインなし)用DataProvider
 *
 * ### 戻り値
 *  - urlOptions: URLオプション
 *  - assert: テストの期待値
 *  - exception: Exception
 *  - return: testActionの実行後の結果
 *
 * @return array
 */
	public function dataProviderIndex() {
		$data = $this->__getData();
		//テストデータ
		$results = array();
		$results[0] = array(
			'urlOptions' => array(
				'frame_id' => $data['frame_id']
			),
			'assert' => array('method' => 'assertEmpty')
		);
		return $results;
	}

/**
 * indexアクションのテスト(ログインなし)
 *
 * @param $urlOptions
 * @param array $assert
 * @param null $exception
 * @param string $return
 * @dataProvider dataProviderIndex
 */
	public function testIndex($urlOptions, $assert, $exception = null, $return = 'view') {
		//テスト実施
		$url = Hash::merge(array(
			'plugin' => $this->plugin,
			'controller' => $this->_controller,
			'action' => 'index',
		), $urlOptions);
		$this->_testGetAction($url, $assert, $exception, $return);
	}

/**
 * indexアクションのテスト(ログインあり)用DataProvider
 *
 * ### 戻り値
 *  - urlOptions: URLオプション
 *  - assert: テストの期待値
 *  - exception: Exception
 *  - return: testActionの実行後の結果
 *
 * @return array
 */
	public function dataProviderIndexLogin() {
		$data = $this->__getData();
		//テストデータ
		$results = array();
		$results[0] = array(
			'urlOptions' => array(
				'frame_id' => $data['frame_id']
			),
			'assert' => array('method' => 'assertNotEmpty'),
		);
		$results[1] = array(
			'urlOptions' => array(
				'frame_id' => $data['frame_id'],
				'content_status' => '99'
			),
			'assert' => null,
			'exception' => 'BadRequestException'
		);
		$results[2] = array(
			'urlOptions' => array(
				'frame_id' => $data['frame_id'],
				'reply_status' => '99',
			),
			'assert' => null,
			'exception' => 'BadRequestException'
		);
		$results[3] = array(
			'urlOptions' => array(
				'frame_id' => $data['frame_id'],
				'sort' => 'abc',
				'direction' => 'abc',
			),
			'assert' => array('method' => 'assertNotEmpty'),
		);
		return $results;
	}

/**
 * indexアクションのテスト(ログインあり)
 *
 * @param $urlOptions
 * @param array $assert
 * @param null $exception
 * @param string $return
 * @dataProvider dataProviderIndexLogin
 */
	public function testIndexLogin($urlOptions, $assert, $exception = null, $return = 'view') {
		//ログイン
		TestAuthGeneral::login($this, Role::ROOM_ROLE_KEY_GENERAL_USER);

		//テスト実施
		$url = Hash::merge(array(
			'plugin' => $this->plugin,
			'controller' => $this->_controller,
			'action' => 'index',
		), $urlOptions);
		$this->_testGetAction($url, $assert, $exception, $return);

		//ログアウト
		TestAuthGeneral::logout($this);
	}
}
