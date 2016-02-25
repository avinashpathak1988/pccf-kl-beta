<?php 
App::uses('AppModel','Model');

class Vouchersfa extends AppModel{
    public $hasMany = array(
        'Vouchersfasdetail'  => array(
            'className'     => 'Vouchersfasdetail',
            'foreignKey'    => 'voucherfa_id',
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
            'foreignKey'    => 'fyear',
            'dependent'     => true,
        ),        
    );
	public $validate=array(
		'account_id'=>array(
				'notBlank'=>array(
						'rule'=>'notBlank',
						'message'=>'Head Of Service must not be empty !',
					),
			),
		'voucher_number'=>array(
				'notBlank'=>array(
					'rule'=>'notBlank',
					'message'=>'Voucher Number must not be Empty !',
				),
				'isUnique'=>array(
					'rule'=>'isUnique',
					'message'=>'Voucher Number already Exists !',
				),
			),	
	);
		
	
    function beforeSave($options = Array()){
        if(is_array($this->data['Vouchersfa']['attach_file']) && count($this->data['Vouchersfa']['attach_file'])>0){
            $attachArr = array();
            foreach($this->data['Vouchersfa']['attach_file'] as $attachKey=>$attachVal){
                if(isset($attachVal['tmp_name']) && $attachVal['tmp_name'] != ''){
                    $ext        = $this->getExt($attachVal['name']);
                    $SoftName   = 'voucher_fa_'.rand().'_'.time().'.'.$ext;
                    $pathName   = './files/voucher/'.$SoftName;
                    if(move_uploaded_file($attachVal['tmp_name'],$pathName)){
                        unset($this->data['Vouchersfa']['attach_file'][$attachKey]);
                        $attachArr[] = $SoftName;
                    }else{
                        return false;
                    }                    
                }
            }
            if(is_array($attachArr) && count($attachArr)>0){
                $this->data['Vouchersfa']['attach_file'] = implode(',',$attachArr);
            }else{
                unset($this->data['Vouchersfa']['attach_file']);
            }
        }
    } 	
}
 ?>