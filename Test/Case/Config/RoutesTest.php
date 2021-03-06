<?php
/**
 * Config/routes.phpのテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsRoutesTestCase', 'NetCommons.TestSuite');

/**
 * Config/routes.phpのテスト
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Pages\Test\Case\Routing\Route\SlugRoute
 */
class RoutesTest extends NetCommonsRoutesTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array();

/**
 * Plugin name
 *
 * @var string
 */
	public $plugin = 'circular_notices';

/**
 * DataProvider
 *
 * ### 戻り値
 * - url URL
 * - expected 期待値
 *
 * @return array テストデータ
 */
	public function dataProvider() {
		return array(
			array(
				'url' => '/circular_notices/circular_notices/view/1/content_key',
				'expected' => array(
					'plugin' => 'circular_notices', 'controller' => 'circular_notices', 'action' => 'view',
					'block_id' => '1', 'key' => 'content_key',
				)
			),
			array(
				'url' => '/circular_notices/circular_notices/edit/1/content_key',
				'expected' => array(
					'plugin' => 'circular_notices', 'controller' => 'circular_notices', 'action' => 'edit',
					'block_id' => '1', 'key' => 'content_key'
				)
			),
			array(
				'url' => '/circular_notices/circular_notices/delete/1/content_key',
				'expected' => array(
					'plugin' => 'circular_notices', 'controller' => 'circular_notices', 'action' => 'delete',
					'block_id' => '1', 'key' => 'content_key'
				)
			),
			array(
				'url' => '/circular_notices/circular_notices/download/1/content_key',
				'expected' => array(
					'plugin' => 'circular_notices', 'controller' => 'circular_notices', 'action' => 'download',
					'block_id' => '1', 'key' => 'content_key',
				)
			),
		);
	}

}
