<?php
/**
 * CircularNoticeFrameSetting Model
 *
 * @property Frame $Frame
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Hirohisa Kuwata <Kuwata.Hirohisa@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('CircularNoticesAppModel', 'CircularNotices.Model');

/**
 * CircularNoticeFrameSetting Model
 *
 * @author Hirohisa Kuwata <Kuwata.Hirohisa@withone.co.jp>
 * @package NetCommons\CircularNotices\Model
 */
class CircularNoticeFrameSetting extends CircularNoticesAppModel {

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
		$this->validate = Hash::merge($this->validate, array(
			'frame_key' => array(
				'notBlank' => array(
					'rule' => array('notBlank'),
					'message' => __d('net_commons', 'Invalid request.'),
					'required' => true,
				)
			),
			'display_number' => array(
				'number' => array(
					'rule' => array('notBlank'),
					'message' => __d('net_commons', 'Invalid request.'),
					'required' => true,
				)
			),
		));

		return parent::beforeValidate($options);
	}

/**
 * Use behaviors
 *
 * @var array
 */
	public $actsAs = array();

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Frame' => array(
			'className' => 'Frames.Frame',
			'foreignKey' => 'frame_key',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

/**
 * Set circular notice frame settings
 *
 * @param int $frameId frames.id
 * @return mixed
 * @throws InternalErrorException
 */
	public function setCircularNoticeFrameSetting($frameId) {
		$this->loadModels([
			'Frame' => 'Frames.Frame',
		]);

		$this->begin();

		try {

			// フレームを取得
			if (! $frame = $this->Frame->findById($frameId)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			// フレームと紐づくフレーム設定が取得できない場合は新規作成
			if (! $frameSetting = $this->findByFrameKey($frame['Frame']['key'])) {
				$data = $this->create(
					array(
						'frame_key' => $frame['Frame']['key'],
						'display_number' => self::DEFAULT_DISPLAY_NUMBER,
					)
				);
				if (! $frameSetting = $this->save($data, false)) {
					throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
				}
			}

			$this->commit();

		} catch (Exception $ex) {
			$this->rollback();
			CakeLog::error($ex);
			throw $ex;
		}

		return $frameSetting;
	}

/**
 * Get circular notice frame settings
 *
 * @param string $created circular_notice_frame_settings.created
 * @return mixed
 */
	public function getCircularNoticeFrameSetting($created) {
		$conditions = array(
			'frame_key' => Current::read('Frame.key')
		);

		$frameSetting = $this->find('first', array(
				'recursive' => -1,
				'conditions' => $conditions,
			)
		);

		if ($created && ! $frameSetting) {
			$frameSetting = $this->create(array(
				'frame_key' => Current::read('Frame.key'),
			));
		}

		return $frameSetting;
	}

/**
 * Save circular notice frame settings
 *
 * @param array $data input data
 * @return bool
 * @throws InternalErrorException
 */
	public function saveCircularNoticeFrameSetting($data) {
		$this->begin();

		try {

			if (! $this->validateCircularNoticeFrameSetting($data)) {
				return false;
			}

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
 * Validate this model
 *
 * @param array $data input data
 * @return bool
 */
	public function validateCircularNoticeFrameSetting($data) {
		$this->set($data);
		$this->validates();
		return $this->validationErrors ? false : true;
	}
}
