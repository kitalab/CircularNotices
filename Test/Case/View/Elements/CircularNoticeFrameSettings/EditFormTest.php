<?php
/**
 * View/Elements/CircularNoticeFrameSettings/edit_formのテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');
App::uses('CircularNoticeFrameSetting', 'CircularNotices.Model');

/**
 * View/Elements/CircularNoticeFrameSettings/edit_formのテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\Case\View\Elements\CircularNoticeFrameSettings\EditForm
 */
class CircularNoticesViewElementsCircularNoticeFrameSettingsEditFormTest extends NetCommonsControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.circular_notices.circular_notice_frame_setting',
	);

/**
 * Plugin name
 *
 * @var string
 */
	public $plugin = 'circular_notices';

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		//テストプラグインのロード
		NetCommonsCakeTestCase::loadTestPlugin($this, 'CircularNotices', 'TestCircularNotices');
		//テストコントローラ生成
		$this->generateNc('TestCircularNotices.TestViewElementsCircularNoticeFrameSettingsEditForm');
	}

/**
 * View/Elements/CircularNoticeFrameSettings/edit_formのテスト
 *
 * @return void
 */
	public function testEditForm() {
		if (!class_exists('CircularNoticeFrameSetting')) {
			App::load('CircularNoticeFrameSetting');
		}

		$this->controller->set('circularNoticeFrameSetting', array('id' => '', 'display_number' => 5));

		//テスト実行
		$this->_testGetAction('/test_circular_notices/test_view_elements_circular_notice_frame_settings_edit_form/edit_form',
				array('method' => 'assertNotEmpty'), null, 'view');

		//チェック
		$pattern = '/' . preg_quote('View/Elements/CircularNoticeFrameSettings/edit_form', '/') . '/';
		$this->assertRegExp($pattern, $this->view);
	}
}
