<?php  
App::uses("AppModel","Model");
class Vouchers10detail extends AppModel{
    public $name            = "Vouchers10detail";
    public $useTable        = "vouchers10details";
    public $primaryKey      = "id";
    
    public $validate = array(
        /*'means_transport'    => array(
            'notBlank'      => array(
                'rule'      => 'notBlank',
                'message'   => 'Must not be Empty !',
            ),
        ),
        'driver_name'    => array(
            'notBlank'      => array(
                'rule'      => 'notBlank',
                'message'   => 'Must not be Empty !',
            ),
        ),
        'quantity_processed'    => array(
            'notBlank'      => array(
                'rule'      => 'notBlank',
                'message'   => 'Must not be Empty !',
            ),
        ),
        'kendu_leaves_bags'    => array(
            'notBlank'      => array(
                'rule'      => 'notBlank',
                'message'   => 'Must not be Empty !',
            ),
        ),*/                                     
    );
}
?>