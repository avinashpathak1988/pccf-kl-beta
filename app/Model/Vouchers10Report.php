<?php  
App::uses("AppModel","Model");
class Vouchers10Report extends AppModel{
    public $name            = "Vouchers10Report";
    public $useTable        = "vouchers10_reports";
    public $primaryKey      = "id";
    
    public $validate = array(
        /*'book_no'           => array(
            'notBlank'      => array(
                'rule'      => 'notBlank',
                'message'   => 'Must not be Empty !',
            ),
            'isUnique'      => array(
                'rule'      => 'isUnique',
                'message'   => 'Voucher no. already exists !',
                'on'        => 'create',
            ),
        ),
        'page_no'           => array(
            'notBlank'      => array(
                'rule'      => 'notBlank',
                'message'   => 'Must not be Empty !',
            ),
        ), 
        'phadi_name'        => array(
            'notBlank'      => array(
                'rule'      => 'notBlank',
                'message'   => 'Must not be Empty !',
            ),
        ), 
        'report_date'       => array(
            'notBlank'      => array(
                'rule'      => 'notBlank',
                'message'   => 'Must not be Empty !',
            ),
            'date'              => array(
                'rule'          => 'date',
                'message'       => 'Enter a valid date',
                'allowEmpty'    => true 
            ),            
        ),  
        'total_collector_no'    => array(
            'notBlank'          => array(
                'rule'          => 'notBlank',
                'message'       => 'Must not be Empty !',
            ),
            'numeric'          => array(
                'rule'          => 'numeric',
                'message'       => 'Must be numeric !',
            ),            
        ),
        'total_keries_puchased_no'    => array(
            'notBlank'          => array(
                'rule'          => 'notBlank',
                'message'       => 'Must not be Empty !',
            ),
            'numeric'          => array(
                'rule'          => 'numeric',
                'message'       => 'Must be numeric !',
            ),             
        ), 
        'total_amount'      => array(
            'notBlank'      => array(
                'rule'      => 'notBlank',
                'message'   => 'Must not be Empty !',
            ),
            'numeric'          => array(
                'rule'          => 'numeric',
                'message'       => 'Must be numeric !',
            ),             
        ), */                                               
    );
}
?>