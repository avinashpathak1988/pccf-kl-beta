<?php 
App::uses('AppModel','Model');


class Accountant extends AppModel{
	
	public $validate=array(
		'email'=>array(
			'email'=>array(
				'rule'=>'email',
				'required'=>false,
				'message'=>'Not a valid E-Mail Format'			
			),
		),
		
		'user_id'=>array(
			'isUnique'=>array(
				'rule'=>'isUnique',
				'message'=>'User ID already exists !',
				'on'=>'create',
			),
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'User ID is required !',
			),
		),
		
		'password'=>array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Password is required',
			),
			'minLength'=>array(
				'rule'=>array('minLength',6),
				'message'=>'Password must be atleast 6 characters long !',
			),
		),
		
		'dfo_id'=>array(
				'notBlank'=>array(
					'rule'=>'notBlank',
					'message'=>'Select DFO !'
				),
			),
	);
	
		public $belongsTo=array('Dfo');
	
}
 ?>