<?php  
App::uses("AppModel","Model");
class Vouchers6 extends AppModel{
    public $name            = "Vouchers6";
    public $useTable        = "vouchers6";
    public $primaryKey      = "id";

    public $hasMany = array(
        'Vouchers6detail'  => array(
            'className'     => 'Vouchers6detail',
            'foreignKey'    => 'vouchers6_id',
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
    public $validate = array( 
        'book_number'        => array(
            'notBlank'          => array(
                'rule'          => 'notBlank',
                'message'       => 'Must not be Empty !',
            ),
            'isUnique'          => array(
                'rule'          => 'isUnique',
                'message'       => 'Book no. already exists !',
                'on'            => 'create',
            ),
        ), 
        'page_number'          => array(
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
        if(is_array($this->data['Vouchers6']['attach_file']) && count($this->data['Vouchers6']['attach_file'])>0){
            $attachArr = array();
            foreach($this->data['Vouchers6']['attach_file'] as $attachKey=>$attachVal){
                if(isset($attachVal['tmp_name']) && $attachVal['tmp_name'] != ''){
                    $ext        = $this->getExt($attachVal['name']);
                    $SoftName   = 'voucher6_'.rand().'_'.time().'.'.$ext;
                    $pathName   = './files/voucher/'.$SoftName;
                    if(move_uploaded_file($attachVal['tmp_name'],$pathName)){
                        unset($this->data['Vouchers6']['attach_file'][$attachKey]);
                        $attachArr[] = $SoftName;
                    }else{
                        return false;
                    }                    
                }
            }
            if(is_array($attachArr) && count($attachArr)>0){
                $this->data['Vouchers6']['attach_file'] = implode(',',$attachArr);
            }else{
                unset($this->data['Vouchers6']['attach_file']);
            }
        }
    }    
}
?>