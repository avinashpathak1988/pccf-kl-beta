<?php 
App::uses('AppModel','Model');

class Admin extends AppModel{
	
	public $validate=array(
			'title'=>array(
				'notBlank'=>array(
					'rule'=>'notBlank',
					'message'=>'Name must not be Empty !',
				),
			),
			
			'email'=>array(
				'email'=>array(
					'rule'=>'email',
					'message'=>'Not a valid E-Mail Format !',
				),
			),
			
			'user_id'=>array(
				'notBlank'=>array(
					'rule'=>'notBlank',
					'message'=>'User ID must not be Empty !',
				),
				'isUnique'=>array(
					'rule'=>'isUnique',
					'message'=>'User ID already exists !',
					'on'=>'create',
				),
			),
			'password'=>array(
				'notBlank'=>array(
					'rule'=>'notBlank',
					'message'=>'Password must not be Empty !',
				),
				'minLength'=>array(
					'rule'=>array('minLength',6),
					'message'=>'Minimum Password strenth must be 6 !',
				),
			),
		);
		
	public $belongsTo=array('Usertype');	
	
}

 ?>