<?php 
App::uses('AppController', 'Controller');

class VouchersfasController extends AppController {
    public $uses = array('Vouchersfa', 'Vouchersfasdetail', 'Account', 'Financialyear', 'VouchersfasAttachment');
    public $components = array('Flash', 'Session');
    public $helpers = array('Html', 'Message', 'Form', 'Money');

    public function afterFilter() {
        $this->response->disableCache();
        if ($this->Session->read('user_id') == '') {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        if ($this->Session->read('fyear') == '') {
            $this->redirect(array('controller' => 'selections', 'action' => 'index'));
        }
    }
    public function index() {
        $this->loadModel('Ro');
        $this->loadModel('Dfo');
        $conds = array();
        $roList = array();
        $dfoList = array();
        $condition = array();
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
            'conditions' => array('is_enable' => 1, 'parent_id != ' => NULL), 
            'order' => array('title' => 'asc'), 
        ));        
        $this->set(array(
            'dfoList'       => $dfoList,
            'roList'        => $roList,
            'title'         => 'FA Vouchers List',
            'usertype_id'   => $this->Session->read('usertype_id'),
            'fyear'         => $fyear,
            'hos'           => $hos,
        ));
    }
    public function indexAjax() {
        $this->layout   = 'ajax';
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
            $condition += array('Vouchersfa.user_id'    => $this->Session->read('user_id'));
        }else if($this->Session->read('usertype_id') == Configure::read('DFOUSERTTYPE')){
            $condition += array('ViewDfoRo.dfo_id'    => $this->Session->read('id'));
        }else if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
            $condition += array('ViewDfoRo.accountant_id'    => $this->Session->read('id'));
        }   
        if(isset($this->params['named']['ro_id']) && (int)$this->params['named']['ro_id'] != 0){
            $ro_id   = $this->params['named']['ro_id'];
            $condition          += array('Vouchersfa.user_id' => $ro_id);
        }
        if(isset($this->params['named']['dfo_id']) && (int)$this->params['named']['dfo_id'] != 0){
            $dfo_id   = $this->params['named']['dfo_id'];
            $condition          += array('ViewDfoRo.dfo_id' => $dfo_id);
        }
        if(isset($this->params['named']['fyear']) && (int)$this->params['named']['fyear'] != 0){
            $fyear   = $this->params['named']['fyear'];
            $condition          += array('Vouchersfa.fyear' => $fyear);
        }
        if(isset($this->params['named']['account_id']) && (int)$this->params['named']['account_id'] != 0){
            $account_id   = $this->params['named']['account_id'];
            $condition          += array('Vouchersfa.account_id' => $account_id);
        } 
        if(isset($this->params['named']['start_date']) && $this->params['named']['start_date'] != ''){
            $start_date   = $this->params['named']['start_date'];
            $condition          += array('Vouchersfa.voucher_date >=' => $this->date2DB($start_date));
        } 
        if(isset($this->params['named']['end_date']) && $this->params['named']['end_date'] != ''){
            $end_date   = $this->params['named']['end_date'];
            $condition          += array('Vouchersfa.voucher_date <=' => $this->date2DB($end_date));
        }
        if(isset($this->params['named']['voucher_status']) && $this->params['named']['voucher_status'] != ''){
            $voucher_status   = $this->params['named']['voucher_status'];
            if($voucher_status == 'A'){
                if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                    $condition          += array('Vouchersfa.is_approve_accountant' => 'Y');
                }else{
                    $condition          += array('Vouchersfa.is_approve_dfo' => 'Y');
                }
            }else if($voucher_status == 'R'){
                if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                    $condition          += array('Vouchersfa.is_reject_accountant' => 'Y');
                }else{
                    $condition          += array('Vouchersfa.is_reject_dfo' => 'Y');
                }
            }else if($voucher_status == 'P'){
                if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                    $condition          += array('Vouchersfa.is_approve_accountant' => 'N','Vouchersfa.is_reject_accountant' => 'N');
                }else{
                    $condition          += array('Vouchersfa.is_approve_dfo' => 'N','Vouchersfa.is_reject_dfo' => 'N');
                }
            }
        }                               
        if(isset($this->params['named']['page']) && $this->params['named']['page'] != ''){
            $page   = $this->params['named']['page'];
        }

        if(isset($this->params['named']['reqType']) && $this->params['named']['reqType'] != ''){
            $this->layout='export_xls';
            if($this->params['named']['reqType']=='XLS'){
                $this->set('file_type','xls');
                $this->set('file_name','favouchers_list'.time().date('d_m_Y').'.xls');
            }else if($this->params['named']['reqType']=='DOC'){
                $this->set('file_type','doc');
                $this->set('file_name','favouchers_list'.time().date('d_m_Y').'.doc');
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
                        'Vouchersfa.user_id = ViewDfoRo.ro_user_id'
                    )
                )                
            ),            
            'conditions' => $condition, 
            'order' => array('Vouchersfa.voucher_date' => 'desc')
        )+$limit;
        $this->set(array(
            'vouchers'          => $this->paginate('Vouchersfa'),
            'usertype_id'       => $this->Session->read('usertype_id'),
            'ro_id'             => $ro_id,
            'dfo_id'            => $dfo_id,   
            'page'              => $page,   
            'fyear'             => $fyear, 
            'account_id'        => $account_id,  
            'start_date'        => $start_date, 
            'end_date'          => $end_date, 
            'voucher_status'    => $voucher_status, 
        ));
    }    
    public function add() {
        $this->response->disableCache();
        if (isset($this->data['Vouchersfa']) && is_array($this->data['Vouchersfa']) && count($this->data['Vouchersfa'])>0) {
            $this->request->data['Vouchersfa']['user_id'] = $this->Session->read('user_id');
            $this->request->data['Vouchersfa']['fyear'] = $this->Session->read('fyear');
            if(isset($this->data['Vouchersfa']['voucher_date']) && $this->data['Vouchersfa']['voucher_date'] != ''){
                $this->request->data['Vouchersfa']['voucher_date'] = $this->date2DB($this->data['Vouchersfa']['voucher_date']);
            }
            if($this->Vouchersfa->saveAll($this->request->data)) {
                $this->request->data['Vouchersfa']['id'] = $this->Vouchersfa->id;
                $this->Flash->success('Voucher Details Saved Successfully !');
            }else{
                $this->Flash->error('Saving Failed !');
            }
        }
        /*
         *Code start for edit voucher6
         */  
        if(isset($this->data['editVoucherfaForm']) && is_array($this->data['editVoucherfaForm']) && count($this->data['editVoucherfaForm'])>0){
            if(isset($this->data['editVoucherfaForm']['id']) && (int)$this->data['editVoucherfaForm']['id'] != 0){
                $this->Vouchersfa->id = $this->data['editVoucherfaForm']['id'];
                if($this->Vouchersfa->exists($this->data['editVoucherfaForm']['id'])){
                    $this->data = $this->Vouchersfa->findById($this->data['editVoucherfaForm']['id']);
                    unset($this->request->data['Vouchersfasdetail']);
                }else{
                    $this->Session->setFlash('Invalid Store.', 'default', array('class' => 'success'));
                }                
            }
        }         
        $account_id = $this->Account->find('list', array(
            'conditions' => array('is_enable' => 1, 'parent_id != ' => NULL), 
            'order' => array('title' => 'asc'), 
        ));
        $fyear = $this->Financialyear->findById($this->Session->read('fyear'));
        $fyear = $fyear['Financialyear']['title'];
        $this->set(array(
            'title'         => 'New FA (XVIII-Form# 110)',
            'account_id'    => $account_id,
            'fyear'         => $fyear,
            'default_date'  => date("d-m-Y"),
            'usertype_id'   => $this->Session->read('usertype_id'),
        ));
    }
    /**
     * View Action
     */
    public function view($id) {
        $voucher_number = null;
        $data = $this->Vouchersfa->findById($id);
        $voucher_number = $data['Vouchersfa']['voucher_number'];
        $this->set(array(
            'usertype_id'       => $this->Session->read('usertype_id'),
            'voucher'           => $data,
            'title'             => 'Detail of  Voucher # '.$voucher_number
        ));
    }
    /**
     * Delete Action
     */
    public function voucherfaDelete(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $this->loadModel('Vouchersfa');
            $this->Vouchersfa->id = $this->data['id'];
            if($this->Vouchersfa->exists()){
                if($this->Vouchersfa->delete()){
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
    public function vouchersfaDetails(){
        $this->layout = 'ajax';
        $details = array();
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $this->loadModel('Vouchersfasdetail');
            $details = $this->Vouchersfasdetail->find('all',array(
                'recursive'     => -1,
                'conditions'    => array(
                    'Vouchersfasdetail.voucherfa_id'    => $this->data['id'],
                ),
            ));
        }
        $this->set(compact('details'));        
    }
    public function vouchersfaDetailsDelete(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $this->loadModel('Vouchersfasdetail');
            $this->Vouchersfasdetail->id = $this->data['id'];
            if($this->Vouchersfasdetail->exists()){
                if($this->Vouchersfasdetail->delete()){
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

    public function voucherfasApprove(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $fields = array();
            $curDate = date('Y-m-d H:i:s');
            $conds = array('Vouchersfa.id' => $this->data['id']);
            if($this->Session->read('usertype_id') == Configure::read('DFOUSERTTYPE')){
                $fields = array(
                    'Vouchersfa.is_approve_dfo'     => "'Y'",
                    'Vouchersfa.approve_dfo_by'     => $this->Session->read('id'),
                    'Vouchersfa.approve_dfo_date'   => "'$curDate'",
                );
            }else if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                $fields = array(
                    'Vouchersfa.is_approve_accountant'      => "'Y'",
                    'Vouchersfa.approve_accountant_by'      => $this->Session->read('id'),
                    'Vouchersfa.approve_accountant_date'    => "'$curDate'",
                );
            }
            $this->loadModel('Vouchersfa');
            $this->Vouchersfa->id = $this->data['id'];
            if($this->Vouchersfa->exists()){
                if(is_array($fields) && count($fields)>0){
                    if($this->Vouchersfa->updateAll($fields,$conds)){
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
    public function voucherfasReject(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $remarks = $this->data['remarks'];
            $fields = array();
            $conds = array('Vouchersfa.id' => $this->data['id']);
            $curDate = date('Y-m-d H:i:s');
            if($this->Session->read('usertype_id') == Configure::read('DFOUSERTTYPE')){
                $fields = array(
                    'Vouchersfa.is_reject_dfo'     => "'Y'",
                    'Vouchersfa.reject_dfo_by'     => $this->Session->read('id'),
                    'Vouchersfa.reject_dfo_date'   => "'$curDate'",
                    'Vouchersfa.dfo_remark'        => "'$remarks'",
                );
            }else if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                $fields = array(
                    'Vouchersfa.is_reject_accountant'      => "'Y'",
                    'Vouchersfa.reject_accountant_by'      => $this->Session->read('id'),
                    'Vouchersfa.reject_accountant_date'    => "'$curDate'",
                    'Vouchersfa.accountant_remark'         => "'$remarks'",
                );
            }
            $this->loadModel('Vouchersfa');
            $this->Vouchersfa->id = $this->data['id'];
            if($this->Vouchersfa->exists()){
                if(is_array($fields) && count($fields)>0){
                    if($this->Vouchersfa->updateAll($fields,$conds)){
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
?>