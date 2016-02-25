<?php 
App::uses('AppModel','Model');

class Worker extends AppModel{
	public $validate=array(
		'title'=>array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Name must not be Empty !',
			),
		),
        'workercategory_id'=>array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Please select category !',
			),
		),
		'ro_id'=>array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Select RO !',
			),
		),
		'card_number'=>array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Card Number must not be Empty !',
			),
			'isUnique'=>array(
				'rule'=>'isUnique',
				'message'=>'Card Number already exists !',
			),
		),
		'worker_code'=>array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Code must not be Empty !',
			),
			'isUnique'=>array(
				'rule'=>'isUnique',
				'message'=>'Code already exists !',
			),
		),
	);
	
	public $belongsTo=array('Ro','Workercategory');
   // public $hasOne=array('Workercategory');
	
}
 ?>