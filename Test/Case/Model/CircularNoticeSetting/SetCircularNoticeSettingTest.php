<?php
/**
 * CircularNoticeSetting::setCircularNoticeSetting()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');
App::uses('BlockFixture', 'Blocks.Test/Fixture');
App::uses('FramesAppModel', 'Frames.Model');
App::uses('FrameFixture', 'Frames.Test/Fixture');
App::uses('BlocksAppModel', 'Blocks.Model');
App::uses('BlockFixture', 'Blocks.Test/Fixture');


/**
 * CircularNoticeSetting::setCircularNoticeSetting()のテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\Case\Model\CircularNoticeSetting
 */
class CircularNoticeSettingSetCircularNoticeSettingTest extends NetCommonsModelTestCase {

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
	protected $_modelName = 'CircularNoticeSetting';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'setCircularNoticeSetting';

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Frame = ClassRegistry::init('Frames.Frame');
		$this->Block = ClassRegistry::init('Blocks.Block');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Frame);
		unset($this->Block);

		parent::tearDown();
	}

/**
 * フレーム取得 例外テスト
 *
 * @return void
 */
	public function testGetLinkedBlockByFrameFalse() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		$frameId = 15;

		// 例外を発生させるためのモック
		$settingMock = $this->getMockForModel('CircularNotices.' . $model, ['getLinkedBlockbyFrame']);
		$settingMock->expects($this->any())
			->method('getLinkedBlockbyFrame')
			->will($this->returnValue(false)
			);
		$result = $settingMock->$methodName($frameId);

		//チェック
		$this->assertFalse($result);
	}

/**
 * フレーム取得 例外テスト
 *
 * @return void
 */
	public function testFindByBlockKey() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		$frameId = 15;

		// 例外を発生させるためのモック
		$settingMock = $this->getMockForModel('CircularNotices.' . $model, ['findByBlockKey']);
		$settingMock->expects($this->any())
			->method('findByBlockKey')
			->will($this->returnValue(false));

		$settingMock->$methodName($frameId);
	}

/**
 * フレーム取得 例外テスト
 *
 * @return void
 */
	public function testGetLinkedBlockbyFrameException() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;
		$this->setExpectedException('InternalErrorException');

		$frameId = 30;

		$settingMock = $this->getMockForModel('CircularNotices.' . $model, ['getLinkedBlockbyFrame']);
		$settingMock->expects($this->any())
			->method('getLinkedBlockbyFrame')
			->will($this->returnValue(false));
		$settingMock->$methodName($frameId);
	}

/**
 * 保存処理 例外テスト
 *
 * @return void
 */
	public function testSaveException() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;
		$this->setExpectedException('InternalErrorException');

		// 例外データ作成
		$this->Frame->save(
			array(
				'id' => '19',
				'language_id' => '2',
				'room_id' => '5',
				'box_id' => 2,
				'plugin_key' => 'circular_notices',
				'block_id' => 33,
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
		$this->Block->save(
			array(
				'id' => '33',
				'language_id' => '2',
				'room_id' => '1',
				'plugin_key' => 'circular_notices',
				'key' => 'false_key',
				'name' => 'Block name 5',
				'public_type' => '2',
				'publish_start' => null,
				'publish_end' => null,
				'created_user' => null,
				'created' => null,
				'modified_user' => null,
				'modified' => null
			)
		);

		$frameId = 19;

		$settingMock = $this->getMockForModel('CircularNotices.' . $model, ['save']);
		$settingMock->expects($this->any())
			->method('save')
			->will($this->returnValue(false));
		$result = $settingMock->$methodName($frameId);

		//チェック
		$this->assertInstanceOf('InternalErrorException', $result);
	}

/**
 * フレーム保存処理 例外テスト
 *
 * @return void
 */
	public function testFrameSave() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;
		$this->setExpectedException('InternalErrorException');

		// 例外データ作成
		$this->Block->save(
			array(
				'id' => '34',
				'language_id' => '2',
				'room_id' => '15',
				'plugin_key' => 'circular_notices',
				'key' => '',
				'name' => 'Block name 5',
				'public_type' => '2',
				'publish_start' => null,
				'publish_end' => null,
				'created_user' => null,
				'created' => null,
				'modified_user' => null,
				'modified' => null
			)
		);

		$frameId = 20;

		$settingMock = $this->getMockForModel('CircularNotices.' . $model, ['save']);
		$settingMock->expects($this->any())
			->method('save')
			->will($this->returnValue(false));
		$result = $settingMock->$methodName($frameId);

		//チェック
		$this->assertTrue($result);
	}

/**
 * SaveのExceptionErrorテスト
 *
 * @param array $data 登録データ
 * @param string $mockModel Mockのモデル
 * @param string $mockMethod Mockのメソッド
 * @return void
 */
	public function testFrameSaveOnExceptionError() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		// 例外データ作成
		$this->Frame->save(
			array(
				'id' => '20',
				'language_id' => '2',
				'room_id' => '5',
				'box_id' => 2,
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

		$frameId = 20;
		$this->_mockForReturnFalse($model, 'Frames.Frame', 'save');
		$this->setExpectedException('InternalErrorException');

		$this->$model->$methodName($frameId);
	}
}
