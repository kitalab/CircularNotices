<?php
/**
 * View/Elements/CircularNotices/select_sortテスト用Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AppController', 'Controller');

/**
 * View/Elements/CircularNotices/select_sortテスト用Controller
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\CircularNotices\Test\test_app\Plugin\TestCircularNotices\Controller
 */
class TestViewElementsCircularNoticesSelectSortController extends AppController {

/**
 * select_sort
 *
 * @return void
 */
	public function select_sort() {
		$this->autoRender = true;
	}

}
