<?php
class MRoleMenu extends AppModel {
	// var $name = 'MRoleMenu';
	// var $useTable = 'm_role_menus';
	// public $primaryKey = 'm_role_menu_id';
   
	public $belongsTo = array(
		'Usertype' => array(
			'className'  => 'Usertype',
			'foreignKey' => 'usertype_id',
		),
		'MMenu' => array(
			'className'  => 'MMenu',
			'foreignKey' => 'm_menu_id'
		),
		'MSubMenu' => array(
			'className'  => 'MSubMenu',
			'foreignKey' => 'm_sub_menu_id'
		),
	  /*'MSubSubMenu' => array(
			'className'  => 'MSubSubMenu',
			'foreignKey' => 'm_sub_sub_menu_id'
		),*/        
	);
	var $validate = array(
	   'usertype_id' => array(
			'rule1'=>array(
				'rule'    => 'notBlank',
				'message' => 'Please select usertype'
			)
		)
	);  
}  