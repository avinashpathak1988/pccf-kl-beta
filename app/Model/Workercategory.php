<?php  
App::uses('AppModel','Model');

class Workercategory extends AppModel{
    public $useTable="workercategories";
    public $primaryKey="id";
    public $displayField="title";
    public $name="Workercategory";
    
    public $validate=array(
        'title'=>array(
            'notBlank'=>array(
                'rule'=>'notBlank',
                'message'=>'Must not be empty !',
            ),
            'isUnique'=>array(
                'rule'=>'isUnique',
                'message'=>'Already Exists !',
                'on' => 'create',
            ),
        ),
    );
    
 //   public $belongsTo=array('Worker');
    
}

?>