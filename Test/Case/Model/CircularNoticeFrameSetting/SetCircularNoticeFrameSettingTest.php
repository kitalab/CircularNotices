<?php
/**
 * CircularNoticeFrameSetting::setCircularNoticeFrameSetting()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');
App::uses('FramesAppModel', 'Frames.Model');
App::uses('FrameFixture', 'Frames.Test/Fixture');

/**
 * CircularNoticeFrameSetting::setCircularNoticeFrameSetting()のテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\Case\Model\CircularNoticeFrameSetting
 */
class CircularNoticeFrameSettingSetCircularNoticeFrameSettingTest extends NetCommonsModelTestCase {

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
	);

/**
 * Plugin name
 *
 * @var string
 */
	public $plugin = 'circular_notices';

/**
 * Model name
 *
 * @var string
 */
	protected $_modelName = 'CircularNoticeFrameSetting';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'setCircularNoticeFrameSetting';

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Frame = ClassRegistry::init('Frames.Frame');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CircularNoticeContent);

		parent::tearDown();
	}

/**
 * setCircularNoticeFrameSetting()のテスト
 *
 * @return void
 */
	public function testSetCircularNoticeFrameSetting() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$frameId = 6;

		//テスト実施
		$result = $this->$model->$methodName($frameId);

		//チェック
		$this->assertTrue(is_array($result));
	}

/**
 * フレームKey取得 例外テスト
 *
 * @return void
 */
	public function testFindFrameKeyException() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;
		$frameId = 6;

		// 例外を発生させるためのモック
		$frameSettingMock = $this->getMockForModel('CircularNotices.' . $model, ['findByFrameKey']);
		$frameSettingMock->expects($this->any())
			->method('findByFrameKey')
			->will($this->returnValue(false));

		$result = $frameSettingMock->$methodName($frameId);

		//チェック
		$this->assertNotEmpty($result);
	}

/**
 * データ保存 例外テスト
 *
 * @return void
 */
	public function testSaveFalse() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;
		$this->setExpectedException('InternalErrorException');

		// 例外データ作成
		$this->Frame->save(
			array(
				'id' => '19',
				'language_id' => '2',
				'room_id' => '5',
				'box_id' => 33,
				'plugin_key' => 'circular_notices',
				'block_id' => null,
				'key' => 'frame_19',
				'name' => 'Test frame main',
				'header_type' => 'default',
				'weight' => '1',
				'is_deleted' => false,
				'default_action' => '',
				'created_user' => null,
				'created' => null,
				'modified_user' => null,
				'modified' => null
			)
		);

		$frameId = 19;

		// 例外を発生させるためのモック
		$frameSettingMock = $this->getMockForModel('CircularNotices.' . $model, ['save']);
		$frameSettingMock->expects($this->any())
			->method('save')
			->will($this->returnValue(false));

		$result = $frameSettingMock->$methodName($frameId);

		//チェック
		$this->assertFalse($result);
	}

/**
 * フレームID取得 例外テスト
 *
 * @return void
 */
	public function testGetFrameIdException() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;
		$this->setExpectedException('InternalErrorException');

		$frameId = 300;

		$result = $this->$model->$methodName($frameId);

		//チェック
		$this->assertNotEmpty($result);
	}
}
