<?php  
App::uses("AppModel","Model");
class Expenditure extends AppModel{
    public $name            = "Expenditure";
    public $useTable        = "expenditures";
    public $primaryKey      = "id";
    public $displayField    = "voucher_no";
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
    public $validate = array(
        'voucher_no'        => array(
            'notBlank'          => array(
                'rule'          => 'notBlank',
                'message'       => 'Must not be Empty !',
            ),
            'isUnique'          => array(
                'rule'          => 'isUnique',
                'message'       => 'Voucher no. already exists !',
                'on'            => 'create',
            ),
        ), 
        'voucher_date'          => array(
            'notBlank'          => array(
                'rule'          => 'notBlank',
                'message'       => 'Must not be Empty !',
            ),
            'date'              => array(
                'rule'          => 'date',
                'message'       => 'Enter a valid date',
                'allowEmpty'    => true 
            ), 
        ), 
        'hos_id'        => array(
            'notBlank'          => array(
                'rule'          => 'notBlank',
                'message'       => 'Must not be Empty !',
            ),
        ), 
        'entry_date'          => array(
            'notBlank'          => array(
                'rule'          => 'notBlank',
                'message'       => 'Must not be Empty !',
            ),
            'date'              => array(
                'rule'          => 'date',
                'message'       => 'Enter a valid date',
                'allowEmpty'    => true 
            ), 
        ), 
        'amount'          => array(
            'notBlank'          => array(
                'rule'          => 'notBlank',
                'message'       => 'Must not be Empty !',
            ),
        ),                         
        /*'attach_file'       => array(
            'fileSize'      => array(
                'rule'      => array('fileSize', '<=', '5MB'),
                'message'   => 'Image must be less than 5MB',
                'allowEmpty'=> true,
                'last'      => false,
            ),
            'extension'     => array(
                'rule'      => array('extension', array('gif', 'jpeg', 'png', 'jpg')),
                'message'   => 'Invalid image',
                'allowEmpty'=> true,
                'required'  => false,
            ),
        ),*/             
    );
    function beforeSave($options = Array()){
        if(is_array($this->data['Expenditure']['attach_file']) && count($this->data['Expenditure']['attach_file'])>0){
            $attachArr = array();
            foreach($this->data['Expenditure']['attach_file'] as $attachKey=>$attachVal){
                if(isset($attachVal['tmp_name']) && $attachVal['tmp_name'] != ''){
                    $ext        = $this->getExt($attachVal['name']);
                    $SoftName   = 'expenditure_'.rand().'_'.time().'.'.$ext;
                    $pathName   = './files/voucher/'.$SoftName;
                    if(move_uploaded_file($attachVal['tmp_name'],$pathName)){
                        unset($this->data['Expenditure']['attach_file'][$attachKey]);
                        $attachArr[] = $SoftName;
                    }else{
                        return false;
                    }                    
                }
            }
            if(is_array($attachArr) && count($attachArr)>0){
                $this->data['Expenditure']['attach_file'] = implode(',',$attachArr);
            }else{
                unset($this->data['Expenditure']['attach_file']);
            }
        }
    }    
}
?>