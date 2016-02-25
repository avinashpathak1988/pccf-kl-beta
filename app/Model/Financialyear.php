<?php 
App::uses('AppModel','Model');

class Financialyear extends AppModel{
	
	public $primaryKey='id';
	public $displayField='title';
	
	public $validate=array(
			'from_year'=>array(
				'rule'=>'notBlank',
				'message'=>'Can not be Empty !'
			),
			'to_year'=>array(
				'rule'=>'notBlank',
				'message'=>'Can not be Empty !'
			),
	);
	
}
 ?>