<?php  
App::uses("AppModel","Model");
class Vouchers6detail extends AppModel{
    public $name            = "Vouchers6detail";
    public $useTable        = "vouchers6details";
    public $primaryKey      = "id";
    
    public $validate = array(
        'means_transport'    => array(
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
        ),                                     
    );
}
?>