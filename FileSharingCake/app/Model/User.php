<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

	//public $name = 'User';
	//public $hasMany = array('Images');
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new SimplePasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
					$this->data[$this->alias]['password']
			);
		}
		return true;
	}
	
	public $validate = array(
			'username' => array(
				array(
					'required'   => true,
					'allowEmpty' => false,
					'message'    => 'Un nom d\'utilisateur est requis'
				)
			),
			'password' => array(
				array(
					'required'   => true,
					'allowEmpty' => false,
					'message'    => 'Un nom d\'utilisateur est requis'
				)
			),
			'role' => array(
					'valid' => array(
							'rule' => array('inList', array('admin', 'user')),
							'message' => 'Merci de rentrer un rôle valide',
							'allowEmpty' => false
					)
			)
	);
	}
	