<?php
class Allocation extends AppModel {
    public $name = 'Allocation';
    public $primaryKey = 'id';
	
	var $validate = array();
/*
 * hasMany associations
 *
 * @var array
 */

    public $belongsTo = array(
        'Financialyear'  => array(
            'className'     => 'Financialyear',
            'foreignKey'    => 'fyear',
        ),     
    );  
    public $hasMany = array(
        'AllocationDetail' => array(
            'className' => 'AllocationDetail',
            'foreignKey' => 'allocation_id',
            'dependent' => true,
        )
    );    
	function beforeSave($options = Array()){
		if(isset($this->data['Allocation']['attachment']['tmp_name']) && $this->data['Allocation']['attachment']['tmp_name'] != '' && (int)$this->data['Allocation']['attachment']['size'] > 0){
            $ext = $this->getExt($this->data['Allocation']['attachment']['name']);
            $softName       = 'fund_doc'.rand().'_'.time().'.'.$ext;
            $pathName        = './files/fundAttachment/'.$softName;
            if(move_uploaded_file($this->data['Allocation']['attachment']['tmp_name'],$pathName)){
                $this->data['Allocation']['attachment'] = $softName;
            }else{
                return false;
            }
        }else{
            unset($this->data['Allocation']['attachment']);
        }
	}	
}