<?php
/**
 * CircularNoticesController::add()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');

/**
 * CircularNoticesController::add()のテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\Case\Controller\CircularNoticesController
 */
class CircularNoticesControllerAddTest extends NetCommonsControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.site_manager.site_setting',
		'plugin.users.user',
		'plugin.mails.mail_setting',
		'plugin.mails.mail_queue',
		'plugin.mails.mail_queue_user',
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
		$blockId = '2';

		$data = array(
			'frame_id' => $frameId,
			'block_id' => $blockId,
		);

		return $data;
	}

/**
 * addアクションのGET用DataProvider
 *
 * ### 戻り値
 *  - urlOptions: URLオプション
 *  - assert: テストの期待値
 *  - exception: Exception
 *  - return: testActionの実行後の結果
 *
 * @return array
 */
	public function dataProviderAdd() {
		$data = $this->__getData();

		//テストデータ
		$results = array();
		$results[0] = array(
			'urlOptions' => Hash::insert($data, 'frame_id', ''),
			'assert' => null,
		);
		$results[1] = array(
			'urlOptions' => $data,
			'assert' => array('method' => 'assertNotEmpty'),
		);
		$results[2] = array(
			'urlOptions' => Hash::insert($data, 'key', 'circular_notice_content_4'),
			'assert' => array('method' => 'assertNotEmpty'),
		);

		return $results;
	}

/**
 * addアクションのテスト
 *
 * @param array $urlOptions URLオプション
 * @param array $assert テストの期待値
 * @param string|null $exception Exception
 * @param string $return testActionの実行後の結果
 * @dataProvider dataProviderAdd
 * @return void
 */
	public function testAdd($urlOptions, $assert, $exception = null, $return = 'view') {
		//ログイン
		TestAuthGeneral::login($this, Role::ROOM_ROLE_KEY_ROOM_ADMINISTRATOR);

		//テスト実施
		$url = Hash::merge(array(
			'plugin' => $this->plugin,
			'controller' => $this->_controller,
			'action' => 'add',
		), $urlOptions);
		$this->_testGetAction($url, $assert, $exception, $return);

		//ログアウト
		TestAuthGeneral::logout($this);
	}

/**
 * addアクションのPost用DataProvider
 *
 * ### 戻り値
 *  - urlOptions: URLオプション
 *  - assert: テストの期待値
 *  - exception: Exception
 *  - return: testActionの実行後の結果
 *
 * @return array
 */
	public function dataProviderAddPost() {
		$data = $this->__getData();

		//テストデータ
		return array(
			array(
				'urlOptions' => $data,
				'data' => array(
					'save_1' => '',
					'Frame' => array('id' => $data['frame_id']),
					'Block' => array('id' => $data['block_id']),
					'CircularNoticeContent' => array(
						'reply_type' => 1,
						'is_room_target' => '',
						'publish_start' => '',
						'publish_end' => '',
						'use_reply_deadline' => 0,
						'reply_deadline' => ''
					),
					'CircularNoticeTargetUser' => array(
						0 => array('user_id' => 1),
					),
				),
				'assert' => array('method' => 'assertNotEmpty'),
			), array(
				'urlOptions' => $data,
				'data' => array(
					'save_1' => '',
					'Frame' => array('id' => $data['frame_id']),
					'Block' => array('id' => $data['block_id']),
					'CircularNoticeContent' => array(
						'id' => '',
						'circular_notice_setting_key' => 'circular_notice_setting_1',
						'title_icon' => '',
						'subject' => 'Lorem ipsum dolor sit amet',
						'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
						'reply_type' => '2',
						'is_room_target' => 1,
						'publish_start' => '2016-01-01 00:00',
						'publish_end' => '2016-12-01 00:00',
						'use_reply_deadline' => '1',
						'reply_deadline' => '2016-06-28 00:00'
					),
					'CircularNoticeChoices' => array(
						0 => array(
							'CircularNoticeChoice' => array(
								'id' => '',
								'weight' => '1',
								'value' => 'aaa',
							),
						),
						1 => array(
							'CircularNoticeChoice' => array(
								'id' => '',
								'weight' => '2',
								'value' => 'bbb',
							),
						),
					),
					'CircularNoticeTargetUser' => array(
						0 => array('user_id' => 1),
					),
				),
				'assert' => array('method' => 'assertNotEmpty'),
			), array(
				'urlOptions' => $data,
				'data' => array(
					'save_1' => '',
					'Frame' => array('id' => $data['frame_id']),
					'Block' => array('id' => $data['block_id']),
					'CircularNoticeContent' => array(
						'id' => '',
						'circular_notice_setting_key' => 'circular_notice_setting_1',
						'title_icon' => '',
						'subject' => 'Lorem ipsum dolor sit amet',
						'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
						'reply_type' => '3',
						'is_room_target' => 1,
						'publish_start' => '2016-01-01 00:00',
						'publish_end' => '2016-12-01 00:00',
						'use_reply_deadline' => '0',
					),
					'CircularNoticeChoices' => array(
						0 => array(
							'CircularNoticeChoice' => array(
								'id' => '',
								'weight' => '1',
								'value' => 'aaa',
							),
						),
					),
					'CircularNoticeTargetUser' => array(
						0 => array('user_id' => 1),
					),
				),
				'assert' => array('method' => 'assertNotEmpty'),
			)
		);
	}

/**
 * editアクションのPOSTテスト
 *
 * @param array $urlOptions URLオプション
 * @param array $data POSTデータ
 * @param array $assert テストの期待値
 * @param string|null $exception Exception
 * @param string $return testActionの実行後の結果
 * @dataProvider dataProviderAddPost
 * @return void
 */
	public function testAddPost($urlOptions, $data, $assert, $exception = null, $return = 'view') {
		//ログイン
		TestAuthGeneral::login($this, Role::ROOM_ROLE_KEY_ROOM_ADMINISTRATOR);
		//テスト実施
		$this->_testPostAction('post', $data, Hash::merge(array('action' => 'add'), $urlOptions), $exception, $return);
		//ログアウト
		TestAuthGeneral::logout($this);
	}
}
