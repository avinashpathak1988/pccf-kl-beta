<?php 
App::uses('AppModel','Model');

class Purchasedetail extends AppModel{
    public $belongsTo = array(
        'Worker'  => array(
            'className'     => 'Worker',
            'foreignKey'    => 'worker_id',
            'dependent'     => true,
        ),       
    );	
	public $validate=array(
			'worker_id'=>array(
					'notBlank'=>array(
							'rule'=>'notBlank',
							'message'=>'Collector Name is required !'
						),
				),
			'amount'=>array(
					'notBlank'=>array(
							'rule'=>'notBlank',
							'message'=>'Amount is required !'
						),
				),	
		);
}
?>		