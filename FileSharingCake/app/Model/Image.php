<?php
 
class Image extends AppModel {

 	public $belongsTo = array(
 			'User' => array(
 					'className' => 'Users',
 					'foreign_key' => 'images_users_fk'
 			)
 	);

}