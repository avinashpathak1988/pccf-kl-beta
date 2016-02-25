<?php
class AllocationDetail extends AppModel {
    public $name = 'AllocationDetail';
    public $primaryKey = 'id';
    /*public $belongsTo = array(
        'Account'  => array(
            'className'     => 'Account',
            'foreignKey'    => 'account_id',
            'dependent'     => true,
        ),        
    );*/
	var $validate = array();

}
?>