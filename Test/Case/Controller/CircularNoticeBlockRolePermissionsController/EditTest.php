<?php
/**
 * CircularNoticeBlockRolePermissionsController::edit()のテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2016, NetCommons Project
 */

App::uses('CircularNoticeBlockRolePermissionsController', 'CircularNotices.Controller');
App::uses('BlockRolePermissionsControllerEditTest', 'Blocks.TestSuite');

/**
 * CircularNoticeBlockRolePermissionsController::edit()のテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\Case\Controller\CircularNoticeBlockRolePermissionsController
 */
class CircularNoticeBlockRolePermissionsControllerEditTest extends BlockRolePermissionsControllerEditTest {

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
 * Controller name
 *
 * @var string
 */
	protected $_controller = 'circular_notice_block_role_permissions';

/**
 * テストDataの取得
 *
 * @param bool $isPost POSTかどうか
 * @return array
 */
	private function __getData($isPost) {
		if ($isPost) {
			$data = array(
				'CircularNoticeSetting' => array(
					'id' => 1,
					'circular_notice_setting_key' => 'circular_notice_2',
				),
			);
		} else {
			$data = array(
				'CircularNoticeSetting' => array(
				),
			);
		}
		return $data;
	}

/**
 * edit()アクションDataProvider
 *
 * ### 戻り値
 *  - approvalFields コンテンツ承認の利用有無のフィールド
 *  - exception Exception
 *  - return testActionの実行後の結果
 *
 * @return void
 */
	public function dataProviderEditGet() {
		return array(
			array('approvalFields' => $this->__getData(false))
		);
	}

/**
 * editアクションのGETテスト(Exceptionエラー)
 *
 * @param array $approvalFields コンテンツ承認の利用有無のフィールド
 * @param string|null $exception Exception
 * @param string $return testActionの実行後の結果
 * @dataProvider dataProviderEditGet
 * @return void
 */
	public function testEditGetExceptionError($approvalFields, $exception = null, $return = 'view') {
		$this->_mockForReturnFalse('CircularNotices.CircularNoticeSetting', 'getCircularNoticeSetting');

		$exception = 'BadRequestException';
		$this->testEditGet($approvalFields, $exception, $return);
	}

/**
 * editアクションのGET(JSON)テスト(Exceptionエラー)
 *
 * @param array $approvalFields コンテンツ承認の利用有無のフィールド
 * @param string|null $exception Exception
 * @param string $return testActionの実行後の結果
 * @dataProvider dataProviderEditGet
 * @return void
 */
	public function testEditGetJsonExceptionError($approvalFields, $exception = null, $return = 'view') {
		$this->_mockForReturnFalse('CircularNotices.CircularNoticeSetting', 'getCircularNoticeSetting');

		$exception = 'BadRequestException';
		$return = 'json';
		$this->testEditGet($approvalFields, $exception, $return);
	}

/**
 * edit()アクションDataProvider
 *
 * ### 戻り値
 *  - data POSTデータ
 *  - exception Exception
 *  - return testActionの実行後の結果
 *
 * @return void
 */
	public function dataProviderEditPost() {
		return array(
			array('data' => $this->__getData(true))
		);
	}

/**
 * editアクションのPOSTテスト(Saveエラー)
 *
 * @param array $data POSTデータ
 * @param string|null $exception Exception
 * @param string $return testActionの実行後の結果
 * @dataProvider dataProviderEditPost
 * @return void
 */
	public function testEditPostSaveError($data, $exception = null, $return = 'view') {
		$data['BlockRolePermission']['content_creatable'] = array(
			Role::ROOM_ROLE_KEY_GENERAL_USER => array(
				'roles_room_id' => 'aaaa',
				'default' => true,
				'value' => '',
				'fixed' => '',
			)
		);

		//テスト実施
		$exception = false;
		$result = $this->testEditPost($data, false, $return);

		$approvalFields = $this->__getData(false);
		$this->assertNotEquals($approvalFields, $result);
	}
}
