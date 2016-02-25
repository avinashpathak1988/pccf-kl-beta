<?php 
App::uses('AppController','Controller');

class RollmenusController extends AppController{
		
	public $uses		= array('Admin','Dfo','Ro','Accountant');
	public $components	= array('Flash','Session','Paginator');
	public $helpers		= array('Html','Message','Form');
	
	function m_menu() {
        $this->loadmodel('MMenu');
        $this->set('title', 'Manage Menu');
        $this->set('button', 'Add Menu');
        if (!empty($this->data['MMenu'])) {
            if ($this->data['MMenu']['id']) {
                $this->MMenu->id = $this->data['MMenu']['id'];
                if ($this->MMenu->save($this->data['MMenu'])) {
                    $this->Session->setFlash('Menu updated successfully','default', array('class' => 'success'));
                    $this->redirect('/Rollmenus/m_menu');
                }
            } else {
                if ($this->MMenu->save($this->data['MMenu'])) {
                    $this->Session->setFlash('Menu added successfully','default', array('class' => 'success'));
                    $this->redirect('/Rollmenus/m_menu');
                }
            }
        }
        if (!empty($this->data['Menuedit'])) {
            $this->data = $this->MMenu->findById($this->data['Menuedit']['id']);
            $this->set('button', 'Update Menu');
        }
        if (!empty($this->data['Menudelete'])) {
            $this->MMenu->delete($this->data['Menudelete']['id']);
            $this->Session->setFlash('Menu deleted successfully','default', array('class' => 'success'));
            $this->redirect('/Rollmenus/m_menu');
        }
        $isactive = array('Y' => 'Active','N' => 'Inactive');
        $this->set('isactive', $isactive);
        $menuList = $this->MMenu->find('all');
        $this->set('menuList', $menuList);
    }
    function m_sub_menu() {
        $this->loadmodel('MMenu');
        $this->loadmodel('MSubMenu');
        $this->set('title', 'Manage Sub Menu');
        $this->set('content_for_title', 'Manage Sub Menu');
        $this->set('button', 'Add SubMenu');
        if (!empty($this->data['MSubMenu'])) {
            if ($this->data['MSubMenu']['id']) {
                $this->MSubMenu->id = $this->data['MSubMenu']['id'];
                //print_r($this->MasterSubMenu->id );exit();
                  $this->loadmodel('MRoleMenu');
                  $this->MRoleMenu->updateAll(array(
                                                      'MRoleMenu.m_menu_id' =>$this->data['MSubMenu']['m_menu_id']
                                                      ),array(
                                                              'MRoleMenu.m_sub_menu_id' =>$this->data['MSubMenu']['m_sub_menu_id']
                                                             ) 
                                                 );
                if ($this->MSubMenu->save($this->data['MSubMenu'])) {
                    $this->Session->setFlash('Sub Menu updated successfully','default', array('class' => 'success'));
                    $this->redirect('/Rollmenus/m_sub_menu');
                }
            } else {
                if ($this->MSubMenu->save($this->data['MSubMenu'])) {
                    $this->Session->setFlash('Sub Menu added successfully','default', array('class' => 'success'));
                    $this->redirect('/Rollmenus/m_sub_menu');
                }
            }
        }
        if (!empty($this->data['SubMenuedit'])) {
            $this->data = $this->MSubMenu->findById($this->data['SubMenuedit']['id']);
            $this->set('button', 'Update SubMenu');
        }
        if (!empty($this->data['SubMenudelete'])) {
            $this->MSubMenu->delete($this->data['SubMenudelete']['id']);
            $this->Session->setFlash('Sub Menu deleted successfully','default', array('class' => 'success'));
            $this->redirect('/Rollmenus/m_sub_menu');
        }
        $menuList = $this->MMenu->find('list',array(
                                                 'condition' => array('MMenu.is_active' => 'Y'),         
                                                 'order'     => array('MMenu.name')
                                                 )); 
        $isactive = array('Y' => 'Active','N' => 'Inactive');
        $this->set('isactive', $isactive);
        $submenuList = $this->MSubMenu->find('all',array(
                                                 'order' => array('MSubMenu.m_menu_id' => 'asc')
                                                 ));
        $this->set(array(
                        'submenuList' => $submenuList,
                        'menuList'    => $menuList
                        ));
    }

	function m_role_menu(){
        $this->loadmodel('Usertype');
        $this->loadmodel('MMenu');
        $this->loadmodel('MSubMenu');
        $this->loadmodel('MRoleMenu');
        $this->set('title','Manage Roll Menus');
        if(isset($this->data['SearchMenu']['usertype_id']) && $this->data['SearchMenu']['usertype_id'] != ''){
            $usertype_id = $this->data['SearchMenu']['usertype_id'];
        }else if(isset($this->data['MRoleMenu']['usertype_id']) && $this->data['MRoleMenu']['usertype_id']){
            $usertype_id = $this->data['MRoleMenu']['usertype_id'];    
        }else{
            $usertype_id = 0;
        }
        $error = 0;
        if(isset($this->data['MRoleMenu']['usertype_id']) && $this->data['MRoleMenu']['usertype_id']){
            if(empty($this->data['MRoleMenu']['MMenu']) && empty($this->data['MRoleMenu']['MSubMenu']) && empty($this->data['MRoleMenu']['MSubSubMenu'])){
                  $this->Session->setFlash('Please Select atlest one menu or submenu or sub sub menu','default', array('class' => 'success'));  
                  $error++;
            }
        }
        /*
         * Only Save Case
         */
        if(!empty($this->data['MRoleMenu']) && $error == 0){
            /*
             * Delete The existing Data For Existing Designation id in Edit case.
             */                                                  
            if(isset($this->data['MRoleMenu']['usertype_id']) && $this->data['MRoleMenu']['usertype_id'] && (isset($this->data['MRoleMenu']['MMenu']) && (count($this->data['MRoleMenu']['MMenu']) > 0) || (isset($this->data['MRoleMenu']['MSubMenu'])&&(count($this->data['MRoleMenu']['MSubMenu']) > 0)) || count($this->data['MRoleMenu']['MSubSubMenu']) > 0 )){
               $this->MRoleMenu->deleteAll(array('MRoleMenu.usertype_id='.$this->data['MRoleMenu']['usertype_id']));
            }
            if(isset($this->data['MRoleMenu']['MMenu'])){
              foreach($this->data['MRoleMenu']['MMenu'] AS $key =>$val){
                $master_menu = array(
                            'usertype_id' => $this->data['MRoleMenu']['usertype_id'],
                            'm_menu_id' => $val,
                            'm_sub_menu_id' => 0,
                            'm_sub_sub_menu_id' => 0,
                           );
                $this->MRoleMenu->create();           
                $this->MRoleMenu->save($master_menu);
                }
            }
            if(isset($this->data['MRoleMenu']['MSubMenu'])){
                foreach($this->data['MRoleMenu']['MSubMenu'] AS $k =>$v){
                   
                    $menu =$this->MSubMenu->find('first',array(
                                                                  'conditions' => array(
                                                                                         'MSubMenu.id' => $v
                                                                                       ),
                                                                   'fields'     =>array('MSubMenu.m_menu_id')                    
                                                                     ));
                    $master_submenu=array(
                                            'usertype_id' => $this->data['MRoleMenu']['usertype_id'],
                                            'm_menu_id' => $menu['MSubMenu']['m_menu_id'],
                                            'm_sub_menu_id' => $v,
                                            'm_sub_sub_menu_id' => 0,
                   
                                         );
                    $this->MRoleMenu->create();
                    $this->MRoleMenu->save($master_submenu);                      
                    
                }
            }
            if(isset($this->data['MRoleMenu']['MSubSubMenu'])){
                foreach($this->data['MRoleMenu']['MSubSubMenu'] AS $k =>$v){
                    
                    $menu =$this->MSubSubMenu->find('first',array(
                                                                  'conditions' => array(
                                                                                         'MSubSubMenu.m_sub_sub_menu_id' => $v
                                                                                       ),
                                                                   'fields'     =>array('MSubSubMenu.m_menu_id','MSubSubMenu.m_sub_menu_id')                    
                                                                     ));
                    $master_sub_sub_menu=array(
                                            'usertype_id' => $this->data['MRoleMenu']['usertype_id'],
                                            'm_menu_id' => $menu['MSubSubMenu']['m_menu_id'],
                                            'm_sub_menu_id' => $menu['MSubSubMenu']['m_sub_menu_id'],
                                            'm_sub_sub_menu_id' => $v,
                                         );
                    $this->MRoleMenu->create();
                    $this->MRoleMenu->save($master_sub_sub_menu);                      
                
                }
            } 
            $this->Session->setFlash('Role Menu inserted Successfully','default', array('class' => 'success'));
            $this->redirect('/Rollmenus/m_role_menu');
        }
        $editMenuList       = array('0');
        $editSubmenuList    = array('0');
        $editSubsubmenuList = array('0');
        
        if($usertype_id != 0){
            
            $editMenuListFind = $this->MRoleMenu->find('all',array(
                                                                  'conditions' => array( 
                                                                          'MRoleMenu.usertype_id' => $usertype_id,
                                                                  ),
                                                  
                                                                  'fields'     =>array(
                                                                       'DISTINCT(MRoleMenu.m_menu_id) AS m_menu_id'
                                                                  ), 
                                                      ));
            if(!empty($editMenuListFind)){
                   foreach($editMenuListFind AS $editMenuListArray){
                       $editMenuList[] = $editMenuListArray[0]['m_menu_id']; 
                   }
            }
            
            
            $editSubmenuListFind = $this->MRoleMenu->find('all',array(
                                                             'conditions' => array(
                                                                                     'MRoleMenu.usertype_id' => $usertype_id,
                                                                                   ),
                                                             'fields'     =>array(
                                                                                  'DISTINCT(MRoleMenu.m_sub_menu_id) AS m_sub_menu_id'
                                                                                  )
                                                         ));
            if(!empty($editSubmenuListFind)){
                   foreach($editSubmenuListFind AS $editSubmenuListArray){
                       $editSubmenuList[] = $editSubmenuListArray[0]['m_sub_menu_id']; 
                   }
            }
            
            
            $editSubsubmenuListFind = $this->MRoleMenu->find('all',array(
                                                                'conditions' => array(
                                                                                        'MRoleMenu.usertype_id' => $usertype_id,
                                                                                      ),
                                                                'fields'     =>array(
                                                                                     'DISTINCT(MRoleMenu.m_sub_sub_menu_id) AS m_sub_sub_menu_id'
                                                                                     )
                                                            ));
            if(!empty($editSubsubmenuListFind)){
                   foreach($editSubsubmenuListFind AS $editSubsubmenuListArray){
                       $editSubsubmenuList[] = $editSubsubmenuListArray[0]['m_sub_sub_menu_id']; 
                   }
            }
        }
        $userTypeList = $this->Usertype->find('list',array(
                                        'conditions'    => array(
                                                                'Usertype.is_enable'   => 1,
                                                            ),
                                        'fields'        => array(
                                                                'Usertype.id','Usertype.title',     
                                                            ),
                                        'order'         => array('Usertype.title'),
                                    ));
        $menuList = $this->MMenu->find('all',array(
                                                'conditions'    => array('MMenu.is_active'   => 'Y'),
                                                'order' => array('MMenu.menu_order'),
                                                'recursive' => 2
                                                ));
        
        $submenuList = $this->MSubMenu->find('all',array(
                                                'order' => array('MSubMenu.sub_menu_order')
                                                 ));                                                                            
        $rolemenuList = $this->MRoleMenu->find('all');
        $this->set('userTypeList', $userTypeList);
        $this->set('menuList', $menuList);
        $this->set('rolemenuList', $rolemenuList);
        $this->set('usertype_id', $usertype_id);
        $this->set('editMenuList', $editMenuList);
        $this->set('editSubmenuList', $editSubmenuList);
        $this->set('editSubsubmenuList', $editSubsubmenuList);
    }
}
 ?>