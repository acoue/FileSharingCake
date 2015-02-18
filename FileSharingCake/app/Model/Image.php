<?php

App::uses('AppModel', 'Model');

class Image extends AppModel {

 	public $belongsTo = array(
 			'User' => array(
 					'className' => 'Users',
 					'foreign_key' => 'images_users_fk'
 			)
 	);
 	
 	public $hasMany = array('ImagesTag');

 	public $hasAndBelongsToMany = array('Tag');
 	
 	public function afterSave($created, $options = array()) {
 		if ($created) {
 			//Tag
	 		//debug($this->data);
 			//die();
 			if(!empty($this->data['Image']['tags'])) {
 				$tags = explode(',', $this->data['Image']['tags']);
 				foreach ($tags as $tag):
 				$tag = trim($tag);
 				if(!empty($tag)) {
 					$data = $this->Tag->findByName($tag);
 					if(!empty($d)) {
 						$this->Tag->id = $data['Tag']['id'];
 					} else {
 						$this->Tag->create();
 						$this->Tag->save(array('name'=>$tag));
 					}
 			$this->loadModel('ImagesTag');
 					$this->ImagesTag->create();
 					$this->ImagesTag->save(array('image_id'=>$this->id,'tag_id'=>$this->Tag->id));
 				}
 				endforeach;
 			}
 		}
 	}
}