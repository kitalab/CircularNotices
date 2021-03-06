<?php
/**
 * CircularNoticeContent::validate()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsValidateTest', 'NetCommons.TestSuite');
App::uses('CircularNoticeContentFixture', 'CircularNotices.Test/Fixture');

/**
 * CircularNoticeContent::validate()のテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\Case\Model\CircularNoticeContent
 */
class CircularNoticeContentValidateTest extends NetCommonsValidateTest {

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
	protected $_modelName = 'CircularNoticeContent';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'validates';

/**
 * ValidationErrorのDataProvider
 *
 * ### 戻り値
 *  - data 登録データ
 *  - field フィールド名
 *  - value セットする値
 *  - message エラーメッセージ
 *  - overwrite 上書きするデータ(省略可)
 *
 * @return array テストデータ
 */
	public function dataProviderValidationError() {
		$data['CircularNoticeContent'] = (new CircularNoticeContentFixture())->records[0];

		return array([
			'data' => $data,
			'field' => '',
			'value' => '',
			'message' => null,
		]);
	}

/**
 * testValidateSelectUserCircularNoticeChoices
 *
 * @return void
 */
	public function testValidateSelectUserCircularNoticeChoices() {
		$model = $this->_modelName;
		$field = 'user_id';
		$data['CircularNoticeContent'] = (new CircularNoticeContentFixture())->records[0];
		$data[$model][$field] = '';

		//validate処理実行
		$this->$model->set($data);
		$result = $this->$model->validates();
		$this->assertFalse($result);

		$this->assertEquals(
		$this->$model->validationErrors[$field],
			__d('circular_notices', 'Select user')
		);
	}

/**
 * testValidateNotEmptyCircularNoticeChoices
 * 
 * @return void
 */
	public function testValidateNotEmptyCircularNoticeChoices() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		$data['CircularNoticeContent'] = (new CircularNoticeContentFixture())->records[1];
		$data['CircularNoticeChoices'] = '';
		$this->$model->data = $data;
		$this->$model->$methodName();

		//return array(
		//array('data' => $data, 'field' => '', 'value' => '',
		//'message' => __d('net_commons', 'Invalid request.')),
		//);
	}
}
