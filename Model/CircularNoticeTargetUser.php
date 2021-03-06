<?php
/**
 * CircularNoticeTargetUser Model
 *
 * @property User $User
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Hirohisa Kuwata <Kuwata.Hirohisa@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('CircularNoticesAppModel', 'CircularNotices.Model');
App::uses('CircularNoticeComponent', 'CircularNotices.Controller/Component');

/**
 * CircularNoticeTargetUser Model
 *
 * @author Hirohisa Kuwata <Kuwata.Hirohisa@withone.co.jp>
 * @package NetCommons\CircularNotices\Model
 */
class CircularNoticeTargetUser extends CircularNoticesAppModel {

/**
 * Default display number
 *
 * @var int
 */
	const DEFAULT_DISPLAY_NUMBER = 10;

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array();

/**
 * Called during validation operations, before validation. Please note that custom
 * validation rules can be defined in $validate.
 *
 * @param array $options Options passed from Model::save().
 * @return bool True if validate operation should continue, false to abort
 * @link http://book.cakephp.org/2.0/en/models/callback-methods.html#beforevalidate
 * @see Model::save()
 */
	public function beforeValidate($options = array()) {
		return parent::beforeValidate($options);
	}

/**
 * Validate empty of reply value.
 *
 * @param array $check check fields.
 * @return bool
 */
	public function validateNotEmptyReplyValue($check) {
		CakeLog::error(var_export($this->data['CircularNoticeTargetUser'], true));
		if (! $this->data['CircularNoticeTargetUser']['reply_text_value'] &&
			! $this->data['CircularNoticeTargetUser']['reply_selection_value']
		) {
			return false;
		}
		return true;
	}

/**
 * Use behaviors
 *
 * @var array
 */
	public $actsAs = array(
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'Users.User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CircularNoticeContent' => array(
			'className' => 'CircularNotices.CircularNoticeContent',
			'foreignKey' => 'circular_notice_content_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

/**
 * Constructor. Binds the model's database table to the object.
 *
 * @param bool|int|string|array $id Set this ID for this model on startup,
 * can also be an array of options, see above.
 * @param string $table Name of database table to use.
 * @param string $ds DataSource connection name.
 * @see Model::__construct()
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 */
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);

		$this->virtualFields['reply_status'] =
			'CASE WHEN ' . $this->alias . '.is_read = 0 THEN ' .
				'\'' . CircularNoticeComponent::CIRCULAR_NOTICE_CONTENT_STATUS_UNREAD . '\' ' .
			'WHEN ' . $this->alias . '.is_read = 1 THEN ' .
				'CASE WHEN ' . $this->alias . '.is_reply = 0 THEN ' .
					'\'' . CircularNoticeComponent::CIRCULAR_NOTICE_CONTENT_STATUS_READ_YET . '\' ' .
				'WHEN ' . $this->alias . '.is_reply = 1 THEN ' .
					'\'' . CircularNoticeComponent::CIRCULAR_NOTICE_CONTENT_STATUS_REPLIED . '\' ' .
				'ELSE ' .
					'NULL ' .
				'END ' .
			'ELSE ' .
				'NULL ' .
			'END';
	}

/**
 * Validate if the user has been selected.
 *
 * @param array $userIdArr ユーザID配列
 * @return bool
 */
	public function isUserSelected($userIdArr) {
		if (!isset($userIdArr) || count($userIdArr) === 0) {
			return false;
		}
		return true;
	}

/**
 * Get count of circular notice target user
 *
 * @param int $contentId circular_notice_target_users.circular_notice_content_id
 * @return array
 */
	public function getCircularNoticeTargetUserCount($contentId) {
		// 条件を設定
		$conditions = array(
			'CircularNoticeTargetUser.circular_notice_content_id' => $contentId,
		);

		// 回覧先件数を取得
		$targetCount = $this->find('count', array(
			'conditions' => $conditions,
		));

		// 閲覧済件数を取得するため条件を追加
		$conditions += array(
			'CircularNoticeTargetUser.is_read' => true
		);

		// 閲覧済件数を取得
		$readCount = $this->find('count', array(
			'conditions' => $conditions,
		));

		// 回答済件数を取得するため条件を追加
		$conditions += array(
			'CircularNoticeTargetUser.is_reply' => true
		);

		// 回答済件数を取得
		$replyCount = $this->find('count', array(
			'conditions' => $conditions,
		));

		// 配列に詰めて返す
		return compact('targetCount', 'readCount', 'replyCount');
	}

/**
 * Get circular notice target users
 *
 * @param int $contentId circular_notice_target_users.circular_notice_content_id
 * @return array
 */
	public function getCircularNoticeTargetUsers($contentId) {
		$conditions = array(
			'CircularNoticeTargetUser.circular_notice_content_id' => $contentId,
		);

		return $this->find('all', array(
			'conditions' => $conditions,
		));
	}

/**
 * Get circular notice target user list for pagination
 *
 * @param int $contentId circular_notice_target_users.circular_notice_content_id
 * @param array $paginatorParams paginator params
 * @param int $userId user id
 * @param int $limit limit
 * @return array
 */
	public function getCircularNoticeTargetUsersForPaginator($contentId, $paginatorParams, $userId,
															$limit = self::DEFAULT_DISPLAY_NUMBER) {
		$this->virtualFields['first_order'] =
			'CASE WHEN CircularNoticeTargetUser.user_id = ' . $userId . ' THEN 1 ELSE 2 END';

		$conditions = array(
			'CircularNoticeTargetUser.circular_notice_content_id' => $contentId,
		);

		// 表示順
		$order = array('User.username' => 'asc');
		if (isset($paginatorParams['sort']) && isset($paginatorParams['direction'])) {
			$order = array($paginatorParams['sort'] => $paginatorParams['direction']);
		}

		// 表示件数
		if (isset($paginatorParams['limit'])) {
			$limit = (int)$paginatorParams['limit'];
		}

		$result = array(
			'recursive' => 0,
			'conditions' => $conditions,
			'order' => $order,
		);
		if ((int)$limit > 0) {
			$result['limit'] = $limit;
		}

		return $result;
	}

/**
 * Hook for Paginator's paginate
 *
 * @param array $conditions conditions
 * @param array $fields fields
 * @param array $order order
 * @param int $limit limit
 * @param int $page page
 * @param int $recursive recursive
 * @param array $extra extra
 * @return mixed
 */
	public function paginate($conditions, $fields, $order, $limit, $page = 1, $recursive = null,
							$extra = array()) {
		// ログイン者を先頭に持ってくるためにorderをカスタム
		$customOrder = array(array('CircularNoticeTargetUser.first_order' => 'asc'));
		if (! empty($order)) {
			$customOrder[] = $order;
		}
		$order = $customOrder;

		return $this->find('all', compact('conditions', 'fields', 'order', 'limit', 'page', 'recursive'));
	}

/**
 * Save for read
 *
 * @param int $contentId circular_notice_contents.id
 * @param int $userId user id
 * @return bool
 * @throws InternalErrorException
 */
	public function saveRead($contentId, $userId) {
		$target = $this->find('first', array(
			'conditions' => array(
				'CircularNoticeTargetUser.circular_notice_content_id' => $contentId,
				'CircularNoticeTargetUser.user_id' => $userId,
			)
		));

		if ($target['CircularNoticeTargetUser']['reply_status'] ==
			CircularNoticeComponent::CIRCULAR_NOTICE_CONTENT_STATUS_UNREAD) {
			if ($target['CircularNoticeContent']['content_status'] ==
				CircularNoticeComponent::CIRCULAR_NOTICE_CONTENT_STATUS_OPEN ||
				$target['CircularNoticeContent']['content_status'] ==
				CircularNoticeComponent::CIRCULAR_NOTICE_CONTENT_STATUS_FIXED
			) {
				$data = array(
					'CircularNoticeTargetUser' => array(
						'id' => $target['CircularNoticeTargetUser']['id'],
						'user_id' => $target['CircularNoticeTargetUser']['user_id'],
						'is_read' => true,
						'read_datetime' => date('Y-m-d H:i:s'),
					)
				);

				if (! $this->saveCircularNoticeTargetUser($data)) {
					throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
				}
			}
		}

		return true;
	}

/**
 * Save circular notice target user
 *
 * @param array $data input data
 * @return bool
 * @throws InternalErrorException
 */
	public function saveCircularNoticeTargetUser($data) {
		$this->begin();

		try {
			// データセット＋検証
			$this->validate['reply_text_value'] = array(
				'notEmpty' => array(
					'rule' => array('validateNotEmptyReplyValue'),
					'last' => false,
					'message' => sprintf(__d('net_commons', 'Please input %s.'),
						__d('circular_notices', 'Answer Title')),
				),
			);
			if (! $this->validateCircularNoticeTargetUser($data)) {
				return false;
			}

			// CircularNoticeTargetUserを保存
			if (! $this->save(null, false)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			$this->commit();

		} catch (Exception $ex) {
			$this->rollback();
			CakeLog::error($ex);
			throw $ex;
		}

		return true;
	}

/**
 * Delete-insert circular notice target users
 *
 * @param array $data input data
 * @return bool
 * @throws InternalErrorException
 */
	public function replaceCircularNoticeTargetUsers($data) {
		$contentId = $data['CircularNoticeContent']['id'];
		$oldContentId =
			isset($data['oldCircularNoticeContentId']) ? $data['oldCircularNoticeContentId'] : 0;

		// 編集時に既に回答済みの情報を保持する
		$existingTargetUsers = $this->find('all', array(
			'recursive' => -1,
			'fields' => array('user_id', 'is_read', 'read_datetime', 'is_reply',
				'reply_datetime', 'reply_text_value', 'reply_selection_value'),
			'conditions' => array('circular_notice_content_id' => $oldContentId)
		));
		$existingTargetUsers =
			Hash::combine($existingTargetUsers, '{n}.CircularNoticeTargetUser.user_id', '{n}');

		// 1件ずつ保存
		if (isset($data['CircularNoticeTargetUsers']) && count($data['CircularNoticeTargetUsers']) > 0) {
			foreach ($data['CircularNoticeTargetUsers'] as $targetUser) {
				$targetUser['CircularNoticeTargetUser']['circular_notice_content_id'] = $contentId;
				if (isset($existingTargetUsers[$targetUser['CircularNoticeTargetUser']['user_id']])
						&& strtotime($data['CircularNoticeContent']['publish_start']) < strtotime('now')) {
					$targetUser = Hash::merge($targetUser,
						$existingTargetUsers[$targetUser['CircularNoticeTargetUser']['user_id']]);
					$targetUser['CircularNoticeTargetUser']['reply_text_value'] = '';		// NC2の仕様を踏襲
					$targetUser['CircularNoticeTargetUser']['reply_selection_value'] = '';	// NC2の仕様を踏襲
				}
				if (! $this->validateCircularNoticeTargetUser($targetUser)) {
					return false;
				}
				if (! $this->save(null, false)) {
					throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
				}
			}
		}

		return true;
	}

/**
 * Validate this model
 *
 * @param array $data input data
 * @return bool
 */
	public function validateCircularNoticeTargetUser($data) {
		$this->set($data);
		$this->validates();
		return $this->validationErrors ? false : true;
	}

/**
 * Get summary of answer.
 *
 * @param int $contentId circular_notice_content.id
 * @return array
 */
	public function getAnswerSummary($contentId) {
		$answerSummary = array();

		$targetUsers = $this->getCircularNoticeTargetUsers($contentId);
		foreach ($targetUsers as $targetUser) {
			$selectionValues = $targetUser['CircularNoticeTargetUser']['reply_selection_value'];
			if ($selectionValues) {
				$answers = explode(CircularNoticeComponent::SELECTION_VALUES_DELIMITER, $selectionValues);
				foreach ($answers as $answer) {
					if (! isset($answerSummary[$answer])) {
						$answerSummary[$answer] = 1;
					} else {
						$answerSummary[$answer]++;
					}
				}
			}
		}

		return $answerSummary;
	}
}