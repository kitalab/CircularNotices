<?php
/**
 * CircularNoticeContentFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Hirohisa Kuwata <Kuwata.Hirohisa@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * CircularNoticeContentFixture
 */
class CircularNoticeContentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary', 'comment' => 'ID |  |  | '),
		'key' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'index', 'collate' => 'utf8_general_ci', 'comment' => 'circulat notice content key | 回覧キー | Hash値 | ', 'charset' => 'utf8'),
		'circular_notice_setting_key' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'index', 'collate' => 'utf8_general_ci', 'comment' => 'circular notice setting key | 回覧板キー | circular_notice_settings.key | ', 'charset' => 'utf8'),
		'title_icon' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8', 'after' => 'circular_notice_setting_key'),
		'language_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => ''),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'is_latest' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'subject' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'subject | 件名 |  | ', 'charset' => 'utf8'),
		'content' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'content | 本文 |  | ', 'charset' => 'utf8'),
		'reply_type' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 1, 'comment' => 'reply type. 1:text field , 2:selection, 3:multiple selection | 回答方式  1:記述式、2:択一式、3:複数選択 |  | '),
		'is_room_target' => array('type' => 'boolean', 'null' => true, 'default' => null, 'comment' => 'is room targeted flag. 0:no , 1:yes  | ルーム対象回覧フラグ |  | '),
		'public_type' => array('type' => 'integer', 'null' => false, 'default' => 1, 'comment' => ''),
		'publish_start' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'opend period (from)  | 回覧期間（開始日時） |  | '),
		'publish_end' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'opend period (to)  | 回覧期間（終了日時） |  | '),
		'use_reply_deadline' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => 'use reply deadline. 0:unset , 1:set | 回答期限設定フラグ |  | '),
		'reply_deadline' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'reply deadline | 回答期限 |  | '),
		'status' => array('type' => 'integer', 'null' => false, 'default' => '3', 'length' => 4, 'comment' => 'status, 1: public, 3: draft during | 公開状況  1:公開中3:下書き中、 |  | '),
		'created_user' => array('type' => 'integer', 'null' => true, 'default' => '0', 'comment' => 'created user | 作成者 | users.id | '),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'created datetime | 作成日時 |  | '),
		'modified_user' => array('type' => 'integer', 'null' => true, 'default' => '0', 'comment' => 'modified user | 更新者 | users.id | '),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'modified datetime | 更新日時 |  | '),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'circular_notice_contents_key1' => array('column' => 'key', 'unique' => 0),
			'fk_circular_notice_contentscircular_notices1' => array('column' => 'circular_notice_setting_key', 'unique' => 0)
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
			'key' => 'circular_notice_content_1',
			'circular_notice_setting_key' => 'circular_notice_setting_1',
			'title_icon' => '',
			'language_id' => '2',
			'is_active' => '1',
			'is_latest' => '1',
			'subject' => 'Lorem ipsum dolor sit amet',
			'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'reply_type' => '1',
			'is_room_target' => false,
			'public_type' => '1',
			'publish_start' => '2015-03-09 09:25:20',
			'publish_end' => '2015-03-09 09:25:20',
			'use_reply_deadline' => '1',
			'reply_deadline' => '2015-03-09 09:25:20',
			'status' => '1',
			'created_user' => '4',
			'created' => '2015-03-09 09:25:20',
			'modified_user' => '4',
			'modified' => '2015-03-09 09:25:20'
		),
		array(
			'id' => '2',
			'key' => 'circular_notice_content_2',
			'circular_notice_setting_key' => 'circular_notice_setting_2',
			'title_icon' => '',
			'language_id' => '2',
			'is_active' => '1',
			'is_latest' => '1',
			'subject' => 'Lorem ipsum dolor sit amet',
			'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'reply_type' => '2',
			'is_room_target' => true,
			'public_type' => '1',
			'publish_start' => '2015-03-09 09:25:20',
			'publish_end' => '2015-03-09 09:25:20',
			'use_reply_deadline' => '1',
			'reply_deadline' => '2015-03-09 09:25:20',
			'status' => '1',
			'created_user' => '3',
			'created' => '2015-03-09 09:25:20',
			'modified_user' => '3',
			'modified' => '2015-03-09 09:25:20'
		),
		array(
			'id' => '3',
			'key' => 'circular_notice_content_3',
			'circular_notice_setting_key' => 'circular_notice_setting_3',
			'title_icon' => '',
			'language_id' => '2',
			'is_active' => '1',
			'is_latest' => '1',
			'subject' => 'Lorem ipsum dolor sit amet',
			'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'reply_type' => '3',
			'is_room_target' => true,
			'public_type' => '1',
			'publish_start' => '2015-03-09 09:25:20',
			'publish_end' => '2015-03-09 09:25:20',
			'use_reply_deadline' => '1',
			'reply_deadline' => '2015-03-09 09:25:20',
			'status' => '1',
			'created_user' => '1',
			'created' => '2015-03-09 09:25:20',
			'modified_user' => '1',
			'modified' => '2015-03-09 09:25:20'
		),
		array(
			'id' => '4',
			'key' => 'circular_notice_content_4',
			'circular_notice_setting_key' => 'circular_notice_setting_4',
			'title_icon' => '',
			'language_id' => '2',
			'is_active' => '1',
			'is_latest' => '1',
			'subject' => 'Lorem ipsum dolor sit amet',
			'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'reply_type' => '3',
			'is_room_target' => true,
			'public_type' => '1',
			'publish_start' => '2015-03-09 09:25:20',
			'publish_end' => '2015-03-09 09:25:20',
			'use_reply_deadline' => '1',
			'reply_deadline' => '2015-03-09 09:25:20',
			'status' => '1',
			'created_user' => '1',
			'created' => '2015-03-09 09:25:20',
			'modified_user' => '1',
			'modified' => '2015-03-09 09:25:20'
		),
		array(
			'id' => '5',
			'key' => 'frame_5',
			'circular_notice_setting_key' => 'frame_5',
			'title_icon' => '',
			'language_id' => '2',
			'is_active' => '1',
			'is_latest' => '1',
			'public_type' => '1',
			'subject' => 'frame_5',
			'content' => 'frame_5',
			'reply_type' => '5',
			'is_room_target' => true,
			'publish_start' => '2015-03-09 09:25:20',
			'publish_end' => '2015-03-09 09:25:20',
			'use_reply_deadline' => '1',
			'reply_deadline' => '2015-03-09 09:25:20',
			'status' => '11',
			'created_user' => '1',
			'created' => '2015-03-09 09:25:20',
			'modified_user' => '1',
			'modified' => '2015-03-09 09:25:20'
		),
		array(
			'id' => '6',
			'key' => 'frame_6',
			'circular_notice_setting_key' => 'frame_6',
			'title_icon' => '',
			'language_id' => '2',
			'is_active' => '1',
			'is_latest' => '1',
			'public_type' => '1',
			'subject' => 'frame_6',
			'content' => 'frame_6',
			'reply_type' => '6',
			'is_room_target' => true,
			'publish_start' => '2015-03-09 09:25:20',
			'publish_end' => '2015-03-09 09:25:20',
			'use_reply_deadline' => '1',
			'reply_deadline' => '2015-03-09 09:25:20',
			'status' => '12',
			'created_user' => '1',
			'created' => '2015-03-09 09:25:20',
			'modified_user' => '1',
			'modified' => '2015-03-09 09:25:20'
		),
		array(
			'id' => '7',
			'key' => 'frame_1',
			'circular_notice_setting_key' => 'circular_notice_4',
			'title_icon' => '',
			'language_id' => '2',
			'is_active' => '1',
			'is_latest' => '1',
			'public_type' => '1',
			'subject' => true,
			'content' => 'frame_4',
			'reply_type' => '1',
			'is_room_target' => true,
			'publish_start' => '2015-03-31 09:25:20',
			'publish_end' => '2070-04-01 23:59:59',
			'use_reply_deadline' => '1',
			'reply_deadline' => '2070-04-01 23:25:20',
			'status' => '3',
			'created_user' => '1',
			'created' => '2015-03-09 09:25:20',
			'modified_user' => '1',
			'modified' => '2015-03-09 09:25:20',
		),
		array(
			'id' => '8',
			'key' => 'frame_4',
			'circular_notice_setting_key' => 'frame_4',
			'title_icon' => '',
			'language_id' => '2',
			'is_active' => '1',
			'is_latest' => '1',
			'public_type' => '1',
			'subject' => true,
			'content' => 'frame_4',
			'reply_type' => '3',
			'is_room_target' => true,
			'publish_start' => '2016-03-10 09:25:20',
			'publish_end' => '2070-04-01 23:59:59',
			'use_reply_deadline' => '1',
			'reply_deadline' => '2016-03-24 23:25:20',
			'status' => '1',
			'created_user' => '1',
			'created' => '2015-03-09 09:25:20',
			'modified_user' => '1',
			'modified' => '2015-03-09 09:25:20',
		),
		array(
			'id' => '9',
			'key' => 'frame_1',
			'circular_notice_setting_key' => 'circular_notice_4',
			'title_icon' => '',
			'language_id' => '2',
			'is_active' => '1',
			'is_latest' => '1',
			'public_type' => '1',
			'subject' => true,
			'content' => 'frame_4',
			'reply_type' => '1',
			'is_room_target' => false,
			'publish_start' => '2015-03-31 09:25:20',
			'publish_end' => '2070-04-01 23:59:59',
			'use_reply_deadline' => '1',
			'reply_deadline' => '2070-04-01 23:25:20',
			'status' => '3',
			'created_user' => '1',
			'created' => '2015-03-09 09:25:20',
			'modified_user' => '1',
			'modified' => '2015-03-09 09:25:20',
		),
		array(
			'id' => '10',
			'key' => 'circular_notice_content_10',
			'circular_notice_setting_key' => 'circular_notice_content_10',
			'title_icon' => '',
			'language_id' => '2',
			'is_active' => '1',
			'is_latest' => '1',
			'public_type' => '1',
			'subject' => true,
			'content' => 'frame_4',
			'reply_type' => '1',
			'is_room_target' => true,
			'publish_start' => '2016-03-10 09:25:20',
			'publish_end' => '2070-04-01 23:59:59',
			'use_reply_deadline' => '0',
			'reply_deadline' => '2016-03-24 23:25:20',
			'status' => '1',
			'created_user' => '1',
			'created' => '2015-03-09 09:25:20',
			'modified_user' => '1',
			'modified' => '2015-03-09 09:25:20',
		),
		array(
			'id' => '11',
			'key' => 'circular_notice_content_11',
			'circular_notice_setting_key' => 'circular_notice_content_11',
			'title_icon' => '',
			'language_id' => '2',
			'is_active' => '1',
			'is_latest' => '1',
			'public_type' => '1',
			'subject' => true,
			'content' => 'frame_11',
			'reply_type' => '2',
			'is_room_target' => true,
			'publish_start' => '2016-03-10 09:25:20',
			'publish_end' => '2070-04-01 23:59:59',
			'use_reply_deadline' => '0',
			'reply_deadline' => '2016-03-24 23:25:20',
			'status' => '1',
			'created_user' => '1',
			'created' => '2015-03-09 09:25:20',
			'modified_user' => '1',
			'modified' => '2015-03-09 09:25:20',
		),
		array(
			'id' => '12',
			'key' => 'circular_notice_content_12',
			'circular_notice_setting_key' => 'circular_notice_content_12',
			'title_icon' => '',
			'language_id' => '2',
			'is_active' => '1',
			'is_latest' => '1',
			'public_type' => '1',
			'subject' => true,
			'content' => 'frame_11',
			'reply_type' => '3',
			'is_room_target' => true,
			'publish_start' => '2016-03-10 09:25:20',
			'publish_end' => '2070-04-01 23:59:59',
			'use_reply_deadline' => '0',
			'reply_deadline' => '2016-03-24 23:25:20',
			'status' => '1',
			'created_user' => '1',
			'created' => '2015-03-09 09:25:20',
			'modified_user' => '1',
			'modified' => '2015-03-09 09:25:20',
		),
		array(
			'id' => '13',
			'key' => 'circular_notice_content_13',
			'circular_notice_setting_key' => 'circular_notice_setting_2',
			'title_icon' => '',
			'language_id' => '2',
			'is_active' => '1',
			'is_latest' => '1',
			'subject' => 'Lorem ipsum dolor sit amet',
			'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'reply_type' => '2',
			'is_room_target' => true,
			'public_type' => '1',
			'publish_start' => null,
			'publish_end' => null,
			'use_reply_deadline' => '1',
			'reply_deadline' => '2015-03-09 09:25:20',
			'status' => '1',
			'created_user' => '3',
			'created' => '2015-03-09 09:25:20',
			'modified_user' => '3',
			'modified' => '2015-03-09 09:25:20'
		),
		array(
			'id' => '14',
			'key' => 'circular_notice_content_14',
			'circular_notice_setting_key' => 'circular_notice_setting_1',
			'title_icon' => '',
			'language_id' => '2',
			'is_active' => '1',
			'is_latest' => '1',
			'subject' => 'Lorem ipsum dolor sit amet',
			'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'reply_type' => '1',
			'is_room_target' => false,
			'public_type' => '1',
			'publish_start' => null,
			'publish_end' => null,
			'use_reply_deadline' => '1',
			'reply_deadline' => '2015-03-09 09:25:20',
			'status' => '1',
			'created_user' => '4',
			'created' => '2015-03-09 09:25:20',
			'modified_user' => '4',
			'modified' => '2015-03-09 09:25:20'
		),
	);
}
