<?php
/**
 * CircularNoticeChoice::validateCircularChoices()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');

/**
 * CircularNoticeChoice::validateCircularChoices()のテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\Case\Model\CircularNoticeChoice
 */
class CircularNoticeChoiceValidateCircularChoicesTest extends NetCommonsModelTestCase {

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
	protected $_modelName = 'CircularNoticeChoice';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'validateCircularChoices';

/**
 * provider
 * @return array
 */
	public function provider() {
		return array(
			'CircularNoticeChoices' => array(
				array(
					'id' => 1,
					'circular_notice_content_id' => 1,
					'value' => 'frame_1',
					'weight' => 1,
					'created_user' => 1,
					'created' => '2015-03-09 09:25:18',
					'modified_user' => 1,
					'modified' => '2015-03-09 09:25:18'
				),
				array(
					'id' => 2,
					'circular_notice_content_id' => 2,
					'value' => null,
					'weight' => 2,
					'created_user' => 2,
					'created' => '2015-03-09 10:25:18',
					'modified_user' => 2,
					'modified' => '2015-03-09 10:25:18'
				),
			),
		);
	}

/**
 * validateCircularChoices()のテスト
 * @dataProvider provider
 * @param $data
 * @return void
 */
	public function testValidateCircularChoices($data) {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$data = null;

		$data['CircularNoticeChoices'] = (new CircularNoticeChoiceFixture())->records;

		//テスト実施
		$result = $this->$model->$methodName($data);

		//チェック
		$this->assertTrue($result);
	}

/**
 * validateCircularChoicesError()のテスト
 *
 * @return void
 */
	public function testValidateCircularChoicesFalse() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		$data['CircularNoticeChoices'] = (new CircularNoticeChoiceFixture())->records;
		// エラーデータ追加
		$data['CircularNoticeChoices'][] = array(
			'id' => 'error_id',
			'circular_notice_content_id' => 'error_id',
			'value' => 'frame_2',
			'weight' => null,
			'created_user' => null,
			'created' => null,
			'modified_user' => null,
			'modified' => null,
			'error' => '1'
		);

		//テスト実施
		$result = $this->$model->$methodName($data);

		//チェック
		$this->assertFalse($result);
	}
}
