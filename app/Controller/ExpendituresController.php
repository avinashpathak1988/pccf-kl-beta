<?php 
App::uses('AppController', 'Controller');

class ExpendituresController extends AppController {
    public $components = array('Flash', 'Session');
    public $helpers = array('Html', 'Message', 'Form', 'Money');
    public $uses = array('Vouchers2b', 'Vouchers2bdetail');
    public function afterFilter() {
        $this->response->disableCache();
        if ($this->Session->read('user_id') == '') {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        if ($this->Session->read('fyear') == '') {
            $this->redirect(array('controller' => 'selections', 'action' => 'index'));
        }
    }
    public function add(){
    	$this->loadModel('Financialyear');
    	$this->loadModel('Account');
    	$this->loadModel('Expenditure');
    	/*
    	 *Code for save data
    	 */
    	if(isset($this->data['Expenditure']) && is_array($this->data['Expenditure']) && count($this->data['Expenditure'])>0){
    		if(isset($this->data['Expenditure']['entry_date']) && $this->data['Expenditure']['entry_date'] != ''){
    			$this->request->data['Expenditure']['entry_date'] = $this->date2DB($this->data['Expenditure']['entry_date']);
    		}
    		if(isset($this->data['Expenditure']['voucher_date']) && $this->data['Expenditure']['voucher_date'] != ''){
    			$this->request->data['Expenditure']['voucher_date'] = $this->date2DB($this->data['Expenditure']['voucher_date']);
    		}    		
    		if($this->Expenditure->save($this->data)){
    			$this->Flash->success('Expenditure has been Saved Successfully !');
				$this->redirect(array('controller' => 'Expenditures', 'action' => 'index'));
    		}else{
    			$this->Flash->error('Saving Failed !');
    		}
    	}
        /*
         *Code start for edit voucher6
         */  
        if(isset($this->data['editExpForm']) && is_array($this->data['editExpForm']) && count($this->data['editExpForm'])>0){
            if(isset($this->data['editExpForm']['id']) && (int)$this->data['editExpForm']['id'] != 0){
                $this->Expenditure->id = $this->data['editExpForm']['id'];
                if($this->Expenditure->exists($this->data['editExpForm']['id'])){
                    $this->data = $this->Expenditure->findById($this->data['editExpForm']['id']);
                }else{
                    $this->Session->setFlash('Invalid Store.', 'default', array('class' => 'success'));
                }                
            }
        }       	
    	/*
    	 *Query for get list of head of service
    	 */
    	$hosList = $this->Account->find('list',array(
    		'recursive'		=> -1,
    		'conditions'	=> array(
    			'Account.parent_id'	=> $this->Session->read('hos'),
    		),
    		'fields'		=> array(
    			'Account.id',
    			'Account.title',
    		),
    	));

        $fyear 			= $this->Financialyear->findById($this->Session->read('fyear'));
        $financialYear 	= $fyear['Financialyear']['title'];  

        $accountArr 	= $this->Account->findById($this->Session->read('hos'));  
        $account 		= $accountArr['Account']['title'];	
    	$this->set(array(
    		'title'			=> 'Add Expenditure',
    		'usertype_id'   => $this->Session->read('usertype_id'),
    		'default_date'  => date("d-m-Y"),
    		'fyear'			=> $this->Session->read('fyear'),
    		'financialYear'	=> $financialYear,
    		'account_id'	=> $this->Session->read('hos'),
    		'account'		=> $account,
    		'hosList'		=> $hosList,
    		'user_id'		=> $this->Session->read('user_id'),
    		'created_by'	=> $this->Session->read('id'),
    	));
    }	
    public function index(){
        $this->loadModel('Ro');
        $this->loadModel('Dfo');
        $this->loadModel('Financialyear');
        $this->loadModel('Account');        
        $conds 		= array();
        $roList 	= array();
        $dfoList 	= array();
        $condition 	= array();
        if($this->Session->read('usertype_id') == Configure::read('ROUSERTTYPE')){
            $conds += array('Ro.id'    => $this->Session->read('id'));
            $condition += array('Dfo.id'    => $this->Session->read('dfo_id'));
        }else if($this->Session->read('usertype_id') == Configure::read('DFOUSERTTYPE')){
            $conds += array('Ro.dfo_id'    => $this->Session->read('id'));
            $condition += array('Dfo.id'    => $this->Session->read('id'));
            $roList = array(''=>'--All--');
        }else if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
            $conds += array('Ro.dfo_id'    => $this->Session->read('dfo_id'));
            $condition += array('Dfo.id'    => $this->Session->read('dfo_id'));
            $roList = array(''=>'--All--');
        }else{
            $dfoList += array(''=>'--All--');
            $roList = array(''=>'--All--');
            $conds += array('Ro.id'    => 0);
        }

        $dfoList += $this->Dfo->find('list',array(
            'recursive'     => -1,
            'fields'        => array(
                'Dfo.id','Dfo.title'
            ),
            'conditions'    => $condition,
        ));
        $roList += $this->Ro->find('list',array(
            'recursive'     => -1,
            'fields'        => array(
                'Ro.user_id','Ro.title'
            ),
            'conditions'    => $conds,
        )); 
        $fyear = $this->Financialyear->find('list', array(
            'conditions' => array('is_enable' => 1), 
            'order' => array('is_default' => 'desc'), 
        ));
        $hos = $this->Account->find('list', array(
            'conditions' => array('is_enable' => 1, 'parent_id IS NULL'), 
            'order' => array('title' => 'asc'), 
        )); 
       	$this->set(array(
    		'title'			=> 'Manage Expenditure',
    		'usertype_id'   => $this->Session->read('usertype_id'),
    		'dfoList'		=> $dfoList,
    		'roList'		=> $roList,
    		'fyear'			=> $fyear,
    		'hos'			=> $hos,
    		'account_id'	=> $this->Session->read('hos'),
    		'fyear_id'		=> $this->Session->read('fyear'),
    	));
    }
    public function indexAjax(){
    	$this->loadModel('Expenditure');
    	$this->layout 	= 'ajax';
        $ro_id          = 0;
        $dfo_id         = 0;
        $page           = 0;
        $fyear          = 0;
        $account_id     = 0;
        $start_date     = '';
        $end_date       = '';
        $voucher_status = '';
        $condition      = array();
        if($this->Session->read('usertype_id') == Configure::read('ROUSERTTYPE')){
            $condition += array('Expenditure.user_id'    => $this->Session->read('user_id'));
        }else if($this->Session->read('usertype_id') == Configure::read('DFOUSERTTYPE')){
            $condition += array('ViewDfoRo.dfo_id'    => $this->Session->read('id'));
        }else if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
            $condition += array('ViewDfoRo.accountant_id'    => $this->Session->read('id'));
        }   
        if(isset($this->params['named']['ro_id']) && (int)$this->params['named']['ro_id'] != 0){
            $ro_id   = $this->params['named']['ro_id'];
            $condition          += array('Expenditure.user_id' => $ro_id);
        }
        if(isset($this->params['named']['dfo_id']) && (int)$this->params['named']['dfo_id'] != 0){
            $dfo_id   = $this->params['named']['dfo_id'];
            $condition          += array('ViewDfoRo.dfo_id' => $dfo_id);
        }
        if(isset($this->params['named']['fyear']) && (int)$this->params['named']['fyear'] != 0){
            $fyear   = $this->params['named']['fyear'];
            $condition          += array('Expenditure.fyear' => $fyear);
        }
        if(isset($this->params['named']['account_id']) && (int)$this->params['named']['account_id'] != 0){
            $account_id   = $this->params['named']['account_id'];
            $condition          += array('Expenditure.account_id' => $account_id);
        }         
        if(isset($this->params['named']['start_date']) && $this->params['named']['start_date'] != ''){
            $start_date   = $this->params['named']['start_date'];
            $condition          += array('Expenditure.voucher_date >=' => $this->date2DB($start_date));
        } 
        if(isset($this->params['named']['end_date']) && $this->params['named']['end_date'] != ''){
            $end_date   = $this->params['named']['end_date'];
            $condition          += array('Expenditure.voucher_date <=' => $this->date2DB($end_date));
        }
        if(isset($this->params['named']['voucher_status']) && $this->params['named']['voucher_status'] != ''){
            $voucher_status   = $this->params['named']['voucher_status'];
            if($voucher_status == 'A'){
                $condition          += array('Expenditure.is_approved_dfo' => 'Y');
            }else if($voucher_status == 'R'){
                $condition          += array('Expenditure.is_rejected_dfo' => 'Y');
            }else if($voucher_status == 'P'){
                $condition          += array('Expenditure.is_approved_dfo' => 'N','Expenditure.is_rejected_dfo' => 'N');
            }
        }                               
        if(isset($this->params['named']['page']) && $this->params['named']['page'] != ''){
            $page   = $this->params['named']['page'];
        }
        if(isset($this->params['named']['reqType']) && $this->params['named']['reqType'] != ''){
            $this->layout='export_xls';
            if($this->params['named']['reqType']=='XLS'){
                $this->set('file_type','xls');
                $this->set('file_name','expenditure_'.time().date('d_m_Y').'.xls');
            }else if($this->params['named']['reqType']=='DOC'){
                $this->set('file_type','doc');
                $this->set('file_name','expenditure_'.time().date('d_m_Y').'.doc');
            }
            $this->set('is_excel','Y');         
            $limit = array('limit' => 2000,'maxLimit'   => 2000);
        }else{
            $limit = array('limit'  => 25);
        }                               
        $this->paginate = array(
            'joins' => array(
                array(
                    'table' => 'view_dfo_ro',
                    'alias' => 'ViewDfoRo',
                    'type'  => 'LEFT',
                    'conditions' => array(
                        'Expenditure.user_id = ViewDfoRo.ro_user_id'
                    )
                ),                                
            ),            
            'conditions' => $condition, 
            'order' => array('Expenditure.voucher_date' => 'desc')
        )+$limit;
        $this->set(array(
            'data'          	=> $this->paginate('Expenditure'),
            'usertype_id'       => $this->Session->read('usertype_id'),
            'ro_id'             => $ro_id,
            'dfo_id'            => $dfo_id,   
            'page'              => $page,   
            'start_date'        => $start_date, 
            'end_date'          => $end_date, 
            'voucher_status'    => $voucher_status, 
        	'fyear'				=> $fyear,
    		'account_id'		=> $account_id,            
        ));    	
    } 
    /**
     * View Action
     */
    public function view($id) {
    	$this->loadModel('Expenditure');
        $voucher_number = null;
        $data = $this->Expenditure->findById($id);
        $voucher_number = $data['Expenditure']['voucher_no'];
        $this->set(array(
            'usertype_id'       => $this->Session->read('usertype_id'),
            'voucher'           => $data,
            'title'             => 'Expenditure Detail of  Voucher # '.$voucher_number
        ));
    }    
    /**
     * Delete Action
     */
    public function expenditureDelete(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $this->loadModel('Expenditure');
            $this->Expenditure->id = $this->data['id'];
            if($this->Expenditure->exists()){
                if($this->Expenditure->delete()){
                    echo 'SUCC';                        
                }else{
                    echo 'FAIL';
                }
            }else{
                echo 'FAIL';
            } 
        }else{
            echo 'FAIL';
        }        
    } 
    /**
     * [voucherfasApprove description]
     * @return [type] [description]
     */
    public function expenditureApprove(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $fields = array();
            $curDate = date('Y-m-d H:i:s');
            $conds = array('Expenditure.id' => $this->data['id']);
            $fields = array(
                'Expenditure.is_approved_dfo'     	=> "'Y'",
                'Expenditure.action_dfo_by'     	=> $this->Session->read('id'),
                'Expenditure.approved_dfo_date'   	=> "'$curDate'",
            );
            $this->loadModel('Expenditure');
            $this->Expenditure->id = $this->data['id'];
            if($this->Expenditure->exists()){
                if(is_array($fields) && count($fields)>0){
                    if($this->Expenditure->updateAll($fields,$conds)){
                        echo 'SUCC';                        
                    }else{
                        echo 'FAIL';
                    }
                }else{
                    echo 'FAIL';
                }
            }else{
                echo 'FAIL';
            } 
        }else{
            echo 'FAIL';
        }        
    }
    /**
     * [voucherfasReject description]
     * @return [type] [description]
     */
    public function expenditureReject(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $remarks = $this->data['remarks'];
            $fields = array();
            $conds = array('Expenditure.id' => $this->data['id']);
            $curDate = date('Y-m-d H:i:s');
            $fields = array(
                'Expenditure.is_rejected_dfo'     	=> "'Y'",
                'Expenditure.action_dfo_by'    	 	=> $this->Session->read('id'),
                'Expenditure.rejected_dfo_date'   	=> "'$curDate'",
                'Expenditure.dfo_remarks'        	=> "'$remarks'",
            );
            $this->loadModel('Expenditure');
            $this->Expenditure->id = $this->data['id'];
            if($this->Expenditure->exists()){
                if(is_array($fields) && count($fields)>0){
                    if($this->Expenditure->updateAll($fields,$conds)){
                        echo 'SUCC';                        
                    }else{
                        echo 'FAIL';
                    }
                }else{
                    echo 'FAIL';
                }
            }else{
                echo 'FAIL';
            } 
        }else{
            echo 'FAIL';
        }        
    }
    public function expenditureAcctRemarks(){
    	$this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $remarks = $this->data['remarks'];
            $fields = array();
            $conds = array('Expenditure.id' => $this->data['id']);
            $curDate = date('Y-m-d H:i:s');
            $fields = array(
                'Expenditure.acc_remark_by'    	 	=> $this->Session->read('id'),
                'Expenditure.acc_remark_date'   	=> "'$curDate'",
                'Expenditure.acc_remarks'        	=> "'$remarks'",
            );
            $this->loadModel('Expenditure');
            $this->Expenditure->id = $this->data['id'];
            if($this->Expenditure->exists()){
                if(is_array($fields) && count($fields)>0){
                    if($this->Expenditure->updateAll($fields,$conds)){
                        echo 'SUCC';                        
                    }else{
                        echo 'FAIL';
                    }
                }else{
                    echo 'FAIL';
                }
            }else{
                echo 'FAIL';
            } 
        }else{
            echo 'FAIL';
        }     	
    }          
}