<?php 
App::uses('AppModel','Model');

class Bank extends AppModel{
	
	
	public $validate=array(
		'title'=>array(
		
		'unique'=>array(
			'rule'=>'isUnique',
			'message'=>'Bank Name already exists !',
			'on'=>'create',
			),
		'notBlank'=>array(
			'rule'=>'notBlank',
			'message'=>'Bank Name can not be Empty !'
			),	
			
		),
		
	);
}
 ?>