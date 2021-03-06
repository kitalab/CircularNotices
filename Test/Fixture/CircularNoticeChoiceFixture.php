<?php
/**
 * CircularNoticeChoiceFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Hirohisa Kuwata <Kuwata.Hirohisa@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * CircularNoticeChoiceFixture
 */
class CircularNoticeChoiceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary', 'comment' => 'ID |  |  | '),
		'circular_notice_content_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index', 'comment' => 'circular notice content id | 回覧ID | circular_notice_contents.id | '),
		'value' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'circular notice\'s choice value | 選択肢 |  | ', 'charset' => 'utf8'),
		'weight' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'circular notice\'s choice value\'s weight | 選択肢表示順 |  | '),
		'created_user' => array('type' => 'integer', 'null' => true, 'default' => '0', 'comment' => 'created user | 作成者 | users.id | '),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'created datetime | 作成日時 |  | '),
		'modified_user' => array('type' => 'integer', 'null' => true, 'default' => '0', 'comment' => 'modified user | 更新者 | users.id | '),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'modified datetime | 更新日時 |  | '),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_circular_notice_target_users_circular_notice_contents1_idx' => array('column' => 'circular_notice_content_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'circular_notice_content_id' => '2',
			'value' => 'Lorem ipsum dolor sit amet',
			'weight' => '1',
			'created_user' => '1',
			'created' => '2015-03-09 09:25:18',
			'modified_user' => '1',
			'modified' => '2015-03-09 09:25:18'
		),
		array(
			'id' => '2',
			'circular_notice_content_id' => '2',
			'value' => 'aliquet feugiat',
			'weight' => '2',
			'created_user' => '1',
			'created' => '2015-03-09 09:25:18',
			'modified_user' => '1',
			'modified' => '2015-03-09 09:25:18'
		),
		array(
			'id' => '3',
			'circular_notice_content_id' => '3',
			'value' => 'Lorem ipsum dolor sit amet',
			'weight' => '1',
			'created_user' => '1',
			'created' => '2015-03-09 10:25:18',
			'modified_user' => '1',
			'modified' => '2015-03-09 10:25:18'
		),
		array(
			'id' => '4',
			'circular_notice_content_id' => '3',
			'value' => 'aliquet feugiat',
			'weight' => '2',
			'created_user' => '1',
			'created' => '2015-03-09 10:25:18',
			'modified_user' => '1',
			'modified' => '2015-03-09 10:25:18'
		),
		array(
			'id' => '5',
			'circular_notice_content_id' => '3',
			'value' => 'Convallis morbi fringilla gravida',
			'weight' => '3',
			'created_user' => '1',
			'created' => '2015-03-09 10:25:18',
			'modified_user' => '1',
			'modified' => '2015-03-09 10:25:18'
		),
		array(
			'id' => '6',
			'circular_notice_content_id' => '11',
			'value' => 'Convallis morbi fringilla gravida',
			'weight' => '3',
			'created_user' => '1',
			'created' => '2015-03-09 10:25:18',
			'modified_user' => '1',
			'modified' => '2015-03-09 10:25:18'
		),
		array(
			'id' => '7',
			'circular_notice_content_id' => '12',
			'value' => 'Convallis morbi fringilla gravida',
			'weight' => '3',
			'created_user' => '1',
			'created' => '2015-03-09 10:25:18',
			'modified_user' => '1',
			'modified' => '2015-03-09 10:25:18'
		),
	);

}
