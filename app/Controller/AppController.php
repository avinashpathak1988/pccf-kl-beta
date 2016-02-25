<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	//public $components = array('Session','Auth');
    function beforeFilter(){
        $portalUrl = Router::url('/', true);
        $this->set(array('domain' => $portalUrl));
        $this->set('req',Configure::read('reqVal'));
        $this->set('funcall',$this);
        /*
         * DESIGNATION WISE MENU LIST
         * THIS IS FOR MENU BAR GENERATION
         */
        if((int)$this->Session->read('usertype_id') != 0){
            $this->loadModel('MRoleMenu');
            $userWiseMenu = $this->MRoleMenu->find('all',array(
                'fields'        =>  array(),
                'conditions'    =>  array('MRoleMenu.usertype_id'=>$this->Session->read('usertype_id')),
                'order'         =>  array(
                    'MMenu.menu_order'                   => 'asc',
                    'MSubMenu.sub_menu_order'            => 'asc',
                ),
            ));
            if(!empty($userWiseMenu)){
                $menu = array();
                $all_url = array();
                foreach($userWiseMenu as $key=>$val){
                    if($val['MMenu']['menu_url']!=''){
                        $menu[$val['MMenu']['name']] = $val['MMenu']['menu_url'];
                    }else if($val['MSubMenu']['sub_menu_url']!=''){
                        $menu[$val['MMenu']['name']][$val['MSubMenu']['name']]=$val['MSubMenu']['sub_menu_url'];
                    }else{
                        //$menu[$val['MMenu']['m_menu_nm']][$val['MSubMenu']['m_sub_menu_nm']][$val['MSubSubMenu']['m_sub_sub_menu_nm']]=$val['MSubSubMenu']['m_sub_sub_menu_url'];
                    }
                    $menu[$val['MMenu']['name'].'-icon'] = $val['MMenu']['menu_icon'];                    
                }
                $this->set(array(
                    'menu'                  => $menu,
                ));
            }
        }
        $this->loadModel('Dfo');
        $dfoCount = $this->Dfo->find('count',array(
            'conditions'    => array(
                'Dfo.is_enable' => 1,
            ),
        ));
        $this->loadModel('Ro');
        $roCount = $this->Ro->find('count',array(
            'conditions'    => array(
                'Ro.is_enable' => 1,
            ),
        ));
        $this->loadModel('Vouchers10');
        $this->loadModel('Vouchers6');
        $this->loadModel('Vouchers2b');
        $this->loadModel('Vouchers4a');
        $this->loadModel('Vouchersfa');
        $this->loadModel('Purchase');        
        $voucher10Count = $this->Vouchers10->find('count');
        $voucher6Count = $this->Vouchers6->find('count');
        $voucher2bCount = $this->Vouchers2b->find('count');
        $voucher4aCount = $this->Vouchers4a->find('count');
        $voucherfaCount = $this->Vouchersfa->find('count');
        $PurchaseCount = $this->Purchase->find('count');   
        $totalVoucherCnt =  intVal($voucher10Count) + intVal($voucher6Count) + intVal($voucher2bCount) + intVal($voucher4aCount) + intVal($voucherfaCount) + intVal($PurchaseCount);            
        
        $voucher10PendCount = $this->Vouchers10->find('count',array(
            'conditions'    => array(
                'Vouchers10.is_approve_dfo' => 'N',
                'Vouchers10.is_reject_dfo' => 'N',
            ),
        ));
        $voucher6PendCount = $this->Vouchers6->find('count',array(
            'conditions'    => array(
                'Vouchers6.is_approve_dfo' => 'N',
                'Vouchers6.is_reject_dfo' => 'N',
            ),
        ));
        $voucher2bPendCount = $this->Vouchers2b->find('count',array(
            'conditions'    => array(
                'Vouchers2b.is_approve_dfo' => 'N',
                'Vouchers2b.is_reject_dfo' => 'N',
            ),
        )); 
        $voucher4aPendCount = $this->Vouchers4a->find('count',array(
            'conditions'    => array(
                'Vouchers4a.is_approve_dfo' => 'N',
                'Vouchers4a.is_reject_dfo' => 'N',
            ),
        )); 
        $voucherfaPendCount = $this->Vouchersfa->find('count',array(
            'conditions'    => array(
                'Vouchersfa.is_approve_dfo' => 'N',
                'Vouchersfa.is_reject_dfo' => 'N',
            ),
        )); 
        $PurchasePendCount = $this->Purchase->find('count',array(
            'conditions'    => array(
                'Purchase.is_approve_dfo' => 'N',
                'Purchase.is_reject_dfo' => 'N',
            ),
        ));                                           
        $totalVoucherPendCnt =  intVal($voucher10PendCount) + intVal($voucher6PendCount) + intVal($voucher2bPendCount) + intVal($voucher4aPendCount) + intVal($voucherfaPendCount) + intVal($PurchasePendCount);              
        $totPercentage = round((intVal($totalVoucherPendCnt) / intVal($totalVoucherCnt)) * 100);
        $this->set(array(
            'dfoCount'          => $dfoCount,
            'roCount'           => $roCount,
            'totalVoucherCnt'   => $totalVoucherCnt,
            'totPercentage'     => $totPercentage,
        )); 
    }
    /**
     * [getExt description]
     * @param  [type] $filename [description]
     * @return [type]           [description]
     */
	function getExt($filename){
        $ext = substr(strtolower(strrchr($filename, '.')), 1);
        return $ext;
    }  
    /**
     * [date2DB description]
     * @param  [type] $dt     [description]
     * @param  string $format [description]
     * @return [type]         [description]
     */
    function date2DB($dt=null,$format='-'){
        if($dt){
            $dateArray = explode($format,$dt);
            if(count($dateArray) > 1){    
                $formatedDate = $dateArray[2].'-'.$dateArray[1].'-'.$dateArray[0];
                return $formatedDate;
            }else{
                return '0000-00-00';
            }
        }else{
            return '0000-00-00';
        }    
    }
    /**
     * [DB2date description]
     * @param [type] $dt [description]
     */
    function DB2date($dt){
        if($dt != '' && $dt != '0000-00-00' && $dt != '1900-01-01' && $dt != '1970-01-01'){
            $formatedDate = date('d-m-Y',strtotime($dt));
            return $formatedDate;
        }    
    }
    /**
     * [generateMySalt description]
     * @return [type] [description]
     */
    function generateMySalt(){
        return rand().rand().rand();
    }
    /**
     * [getAccountName description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    function getAccountName($id){
        if($id){
            $this->loadModel('Accountant');
            $data = $this->Accountant->find('first',array(
                'recursive'     => -1,
                'conditions'    => array(
                    'Accountant.id' => $id,
                ),
                'fields'        => array(
                    'Accountant.title'
                ),
            ));
            if(isset($data['Accountant']['title']) && $data['Accountant']['title'] != ''){
                return $data['Accountant']['title'];
            }else{
                return '';
            }
        }else{
            return '';
        }
    }
    /**
     * [getDfoName description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    function getDfoName($id){
        if($id){
            $this->loadModel('Dfo');
            $data = $this->Dfo->find('first',array(
                'recursive'     => -1,
                'conditions'    => array(
                    'Dfo.id' => $id,
                ),
                'fields'        => array(
                    'Dfo.title'
                ),
            ));
            if(isset($data['Dfo']['title']) && $data['Dfo']['title'] != ''){
                return $data['Dfo']['title'];
            }else{
                return '';
            }
        }else{
            return '';
        }
    }
    /**
     * [getPccfName description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    function getPccfName($id){
        if($id){
            $this->loadModel('Admin');
            $data = $this->Admin->find('first',array(
                'recursive'     => -1,
                'conditions'    => array(
                    'Admin.id' => $id,
                ),
                'fields'        => array(
                    'Admin.title'
                ),
            ));
            if(isset($data['Admin']['title']) && $data['Admin']['title'] != ''){
                return $data['Admin']['title'];
            }else{
                return '';
            }
        }else{
            return '';
        }
    } 
    /**
     * [getRoName description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    function getRoName($id){
        if($id){
            $this->loadModel('Ro');
            $data = $this->Ro->find('first',array(
                'recursive'     => -1,
                'conditions'    => array(
                    'Ro.id' => $id,
                ),
                'fields'        => array(
                    'Ro.title'
                ),
            ));
            if(isset($data['Ro']['title']) && $data['Ro']['title'] != ''){
                return $data['Ro']['title'];
            }else{
                return '';
            }
        }else{
            return '';
        }
    }
    /**
     * [getRoName description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    function getUserIdRoName($userId){
        if($userId){
            $this->loadModel('Ro');
            $data = $this->Ro->find('first',array(
                'recursive'     => -1,
                'conditions'    => array(
                    'Ro.user_id' => $userId,
                ),
                'fields'        => array(
                    'Ro.title'
                ),
            ));
            if(isset($data['Ro']['title']) && $data['Ro']['title'] != ''){
                return $data['Ro']['title'];
            }else{
                return '';
            }
        }else{
            return '';
        }
    }    
    /**
     * [yearWiseExepAmt description]
     * @param  [type] $fyear [description]
     * @return [type]        [description]
     */
    function yearWiseExepAmt($fyear){
        if($fyear){
            $this->loadModel('Allocation');
            $allocationExpDetails = $this->Allocation->find('all',array(
                'joins'=>array(
                    array(
                        'table' => 'allocation_details',
                        'alias' => 'AllocationDetail',
                        'type' => 'left',
                        'foreignKey' => false,
                        'conditions'=> array(
                            'AllocationDetail.allocation_id = Allocation.id',
                        )                   
                    ),
                ),
                'fields'        => array(
                        'SUM(AllocationDetail.amount) As amountbalance',
                ),
                'conditions'        => array(
                    'Allocation.assign_by'            => $this->Session->read('id'),
                    'Allocation.usertype_id'          => $this->Session->read('usertype_id'),
                    'Allocation.fyear'            => $fyear,
                ),
            ));
            if(isset($allocationExpDetails[0][0]['amountbalance'])){
                return $allocationExpDetails[0][0]['amountbalance'];
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    } 
    public function getHOSName($id){
        if($id){
            $this->loadModel('Account');
            $data = $this->Account->find('first',array(
                'recursive'     => -1,
                'conditions'    => array(
                    'Account.id'    => $id,
                ),
                'fields'        => array(
                    'Account.title'
                ),
            ));
            if(isset($data['Account']['title']) && $data['Account']['title'] != ''){
                return $data['Account']['title'];
            }else{
                return '';
            }
        }else{
            return '';
        }
    }   

    public function getFaDetails($usertype_id = 0, $user_id = 0, $fyear = 0, $account_id = 0){
        $this->loadModel('FinancialAdvance');
        $advanceTaken = array();
        $usertype_id = ($usertype_id == 0) ? $this->Session->read('usertype_id'): $usertype_id;
        $user_id = ($user_id == 0) ? $this->Session->read('id'): $user_id;
        $fyear = ($fyear == 0) ? $this->Session->read('fyear'): $fyear;
        $account_id = ($account_id == 0) ? $this->Session->read('hos'): $account_id;
        $condition = array(
            "FinancialAdvance.fyear"                => $fyear,
            "FinancialAdvance.account_id"           => $account_id
        );
        $conditionTaken = array(
            "FinancialAdvance.created_by"           => $user_id,
            "FinancialAdvance.usertype_id"          => $usertype_id
        );
        $conditionGiven = array(
            "FinancialAdvance.from_user_id"         => $user_id,
            "FinancialAdvance.from_usertype_id"     => $usertype_id
        );
        $advanceTaken = $this->FinancialAdvance->find("first", array(
            "conditions"    => $condition+$conditionTaken,
            "fields"        => array(
                "sum(amount) as total_advance",
            ),
        ));
        $advanceGiven = $this->FinancialAdvance->find("first", array(
                "conditions"    => $condition+$conditionGiven,
                "fields"        => array(
                    "sum(amount) as total_advance_given",
                ),
            ));
        $advanceTaken = array(
                "advance_taken"     => $advanceTaken[0]['total_advance'],
                "advance_given"     => $advanceGiven[0]['total_advance_given'],
                "balance"           => $advanceTaken[0]['total_advance'] - $advanceGiven[0]['total_advance_given'],
            ); 
        return $advanceTaken;
    }             	
}
