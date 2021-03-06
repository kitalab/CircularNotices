<?php
/**
 * CircularNoticeSetting::getLinkedBlockbyFrame()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsGetTest', 'NetCommons.TestSuite');

/**
 * CircularNoticeSetting::getLinkedBlockbyFrame()のテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\Case\Model\CircularNoticeSetting
 */
class CircularNoticeSettingGetLinkedBlockbyFrameTest extends NetCommonsGetTest {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.frames.frame',
		'plugin.blocks.block',
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
	protected $_methodName = 'getLinkedBlockbyFrame';

/**
 * getLinkedBlockbyFrame()のテスト
 *
 * @return void
 */
	public function testGetLinkedBlockbyFrame() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$frame['Frame'] = (new FrameFixture())->records[0];
		$block['Block'] = (new BlockFixture())->records[0];
		$blockMock = $this->getMockForModel('Blocks.Block');
		$blockMock->expects($this->once())
			->method('save')
			->will($this->returnValue(true));
		$blockMock->expects($this->once())
			->method('find')
			->will($this->returnValue(true));
		$blockMock->save($block);

		//テスト実施
		$result = $this->$model->$methodName($frame);

		//チェック
		$this->assertTrue($result);
	}

/**
 * getLinkedBlockbyFrame()のテスト
 *
 * @return void
 */
	public function testGetLinkedBlockbyFrameFalse() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$frame = null;

		//テスト実施
		$result = $this->$model->$methodName($frame);

		//チェック
		$this->assertFalse($result);
	}

}
