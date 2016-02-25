<?php  
App::uses("AppModel","Model");
class Vouchers2bdetail extends AppModel{
    public $name            = "Vouchers2bdetail";
    public $useTable        = "vouchers2bdetails";
    public $primaryKey      = "id";
    
    public $validate = array(
        'collection_date'       => array(
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
        'phadi_name'    => array(
            'notBlank'      => array(
                'rule'      => 'notBlank',
                'message'   => 'Must not be Empty !',
            ),
        ),
        'keries_purchased_no'    => array(
            'notBlank'      => array(
                'rule'      => 'notBlank',
                'message'   => 'Must not be Empty !',
            ),
        ),
        'amount'    => array(
            'notBlank'      => array(
                'rule'      => 'notBlank',
                'message'   => 'Must not be Empty !',
            ),
        ),                            
    );
}
?>