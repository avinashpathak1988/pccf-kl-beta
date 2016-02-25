<?php 
App::uses('AppModel','Model');
class Purchase extends AppModel{
	public $displayField="code";
    public $hasMany = array(
        'Purchasedetail'  => array(
            'className'     => 'Purchasedetail',
            'foreignKey'    => 'purchase_id',
            'dependent'     => true,
        ),  
    );
    public $belongsTo = array(
        'Account'  => array(
            'className'     => 'Account',
            'foreignKey'    => 'account_id',
            'dependent'     => true,
        ),
        'Financialyear'  => array(
            'className'     => 'Financialyear',
            'foreignKey'    => 'financialyear_id',
            'dependent'     => true,
        ), 
        'Ro'  => array(
            'className'     => 'Ro',
            'foreignKey'    => 'ro_id',
            'dependent'     => true,
        ),
    );  	
	public $validate=array(
		'code'=>array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Code must not be Empty !',
			),
			'isUnique'=>array(
				'rule'=>'isUnique',
				'message'=>'Code already exists !',
				'on'=>'create',
			),	
		),
		'edate'=>array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Date must not be Empty !',
			),
		),	
	);
    function beforeSave($options = Array()){
        if(is_array($this->data['Purchase']['attach_file']) && count($this->data['Purchase']['attach_file'])>0){
            $attachArr = array();
            foreach($this->data['Purchase']['attach_file'] as $attachKey=>$attachVal){
                if(isset($attachVal['tmp_name']) && $attachVal['tmp_name'] != ''){
                    $ext        = $this->getExt($attachVal['name']);
                    $SoftName   = 'purchase_'.rand().'_'.time().'.'.$ext;
                    $pathName   = './files/voucher/'.$SoftName;
                    if(move_uploaded_file($attachVal['tmp_name'],$pathName)){
                        unset($this->data['Purchase']['attach_file'][$attachKey]);
                        $attachArr[] = $SoftName;
                    }else{
                        return false;
                    }                    
                }
            }
            if(is_array($attachArr) && count($attachArr)>0){
                $this->data['Purchase']['attach_file'] = implode(',',$attachArr);
            }else{
                unset($this->data['Purchase']['attach_file']);
            }
        }
    }	
	
}
 ?>