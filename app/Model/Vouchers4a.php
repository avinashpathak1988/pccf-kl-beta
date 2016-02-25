<?php  
App::uses("AppModel","Model");

class Vouchers4a extends AppModel{
    public $name="Vouchers4a";
    public $useTable="vouchers4a";
    public $primaryKey="id";
    public $displayField="code";

    public $hasMany = array(
        'Vouchers4adetail'  => array(
            'className'     => 'Vouchers4adetail',
            'foreignKey'    => 'vouchers4a_id',
            'dependent'     => true,
        ),    
        'Vouchers4aReport'  =>   array(
            'className'     => 'Vouchers4aReport',
            'foreignKey'    => 'vouchers4a_id',
            'dependent'     => true,
        ),         
    );
    
    public $validate=array(
        'code'=>array(
            'notBlank'=>array(
                'rule'=>'notBlank',
                'message'=>'Must not be Empty !',
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
    
}
?>