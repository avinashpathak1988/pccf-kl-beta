<?php 
App::uses('AppController', 'Controller');

class Vouchers10Controller extends AppController {
    public $components = array('Flash', 'Session');
    public $helpers = array('Html', 'Message', 'Form', 'Money');
    public $uses = array('Vouchers10', 'Vouchers10detail');

    /*Filter Session Values*/
    public function afterFilter() {
        $this->response->disableCache();
        if ($this->Session->read('user_id') == '') {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        if ($this->Session->read('fyear') == '') {
            $this->redirect(array('controller' => 'selections', 'action' => 'index'));
        }

    }
    /*Index Action*/
    public function index() {
        $this->loadModel('Ro');
        $this->loadModel('Dfo');
        $this->loadModel('Financialyear');
        $this->loadModel('Account');         
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
            'title'         => 'Transit Permit (Form No.-10) List',
            'dfoList'       => $dfoList,
            'roList'        => $roList,
            'usertype_id'   => $this->Session->read('usertype_id'),
            'fyear'         => $fyear,
            'hos'           => $hos,              
        ));
    }
    public function indexAjax(){
        $this->layout = 'ajax';
        $this->loadModel('Vouchers10');
        $ro_id          = 0;
        $dfo_id         = 0;
        $page           = 0;
        $fyear          = 0;
        $account_id     = 0;
        $start_date     = '';
        $end_date       = '';
        $voucher_status = '';  
        /*
         *Query for get the report
         */
        $condition = array();
        if($this->Session->read('usertype_id') == Configure::read('ROUSERTTYPE')){
            $condition += array('Vouchers10.user_id'    => $this->Session->read('user_id'));
        }else if($this->Session->read('usertype_id') == Configure::read('DFOUSERTTYPE')){
            $condition += array('ViewDfoRo.dfo_id'    => $this->Session->read('id'));
        }else if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
            $condition += array('ViewDfoRo.accountant_id'    => $this->Session->read('id'));
        }
        if(isset($this->params['named']['ro_id']) && (int)$this->params['named']['ro_id'] != 0){
            $ro_id   = $this->params['named']['ro_id'];
            $condition          += array('Vouchers10.user_id' => $ro_id);
        }
        if(isset($this->params['named']['dfo_id']) && (int)$this->params['named']['dfo_id'] != 0){
            $dfo_id   = $this->params['named']['dfo_id'];
            $condition          += array('ViewDfoRo.dfo_id' => $dfo_id);
        }  
        if(isset($this->params['named']['fyear']) && (int)$this->params['named']['fyear'] != 0){
            $fyear   = $this->params['named']['fyear'];
            $condition          += array('Vouchers10.fyear' => $fyear);
        }
        if(isset($this->params['named']['account_id']) && (int)$this->params['named']['account_id'] != 0){
            $account_id   = $this->params['named']['account_id'];
            $condition          += array('Vouchers10.account_id' => $account_id);
        } 
        if(isset($this->params['named']['start_date']) && $this->params['named']['start_date'] != ''){
            $start_date   = $this->params['named']['start_date'];
            $condition          += array('Vouchers10.voucher_date >=' => $this->date2DB($start_date));
        } 
        if(isset($this->params['named']['end_date']) && $this->params['named']['end_date'] != ''){
            $end_date   = $this->params['named']['end_date'];
            $condition          += array('Vouchers10.voucher_date <=' => $this->date2DB($end_date));
        }
        if(isset($this->params['named']['voucher_status']) && $this->params['named']['voucher_status'] != ''){
            $voucher_status   = $this->params['named']['voucher_status'];
            if($voucher_status == 'A'){
                if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                    $condition          += array('Vouchers10.is_approve_accountant' => 'Y');
                }else{
                    $condition          += array('Vouchers10.is_approve_dfo' => 'Y');
                }
            }else if($voucher_status == 'R'){
                if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                    $condition          += array('Vouchers10.is_reject_accountant' => 'Y');
                }else{
                    $condition          += array('Vouchers10.is_reject_dfo' => 'Y');
                }
            }else if($voucher_status == 'P'){
                if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                    $condition          += array('Vouchers10.is_approve_accountant' => 'N','Vouchers10.is_reject_accountant' => 'N');
                }else{
                    $condition          += array('Vouchers10.is_approve_dfo' => 'N','Vouchers10.is_reject_dfo' => 'N');
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
                $this->set('file_name','voucher10_list'.time().date('d_m_Y').'.xls');
            }else if($this->params['named']['reqType']=='DOC'){
                $this->set('file_type','doc');
                $this->set('file_name','voucher10_list'.time().date('d_m_Y').'.doc');
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
                        'Vouchers10.user_id = ViewDfoRo.ro_user_id'
                    )
                )                
            ),
            'conditions'=> $condition,
            'order' => array('id' => 'desc'),
        )+$limit;
        $vouchers = $this->paginate('Vouchers10');
        $this->set(array(
            'vouchers'          => $vouchers,
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
    /**
     * [view description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function view($id){
        $data = array();
        if($id){
            $this->loadModel('Vouchers10');
            $data = $this->Vouchers10->find('first',array(
                'conditions'    => array(
                    'Vouchers10.id'     => $id,
                ),
            ));
        }
        $this->set(array(
            'data'          => $data,
            'title'         => 'View Transit Permit (Form No.-10)',
            'usertype_id'   => $this->Session->read('usertype_id'),
        ));
    }
    /*Add Action*/
    /**
     * [add description]
     */
    public function add(){
        $this->response->disableCache();
        $this->loadModel('Account');
        $this->loadModel('Financialyear');
        $this->loadModel('Vouchers10');
        /*
         *Save voucher10 data
         */
        if(isset($this->data['Vouchers10']) && is_array($this->data['Vouchers10']) && count($this->data['Vouchers10'])>0){
            if(isset($this->data['Vouchers10']['voucher_date']) && $this->data['Vouchers10']['voucher_date'] != ''){
                $this->request->data['Vouchers10']['voucher_date'] = $this->date2DB($this->data['Vouchers10']['voucher_date']);
            } 
            if(isset($this->data['Vouchers10']['from_date']) && $this->data['Vouchers10']['from_date'] != ''){
                $this->request->data['Vouchers10']['from_date'] = $this->date2DB($this->data['Vouchers10']['from_date']);
            }
            if(isset($this->data['Vouchers10']['to_date']) && $this->data['Vouchers10']['to_date'] != ''){
                $this->request->data['Vouchers10']['to_date'] = $this->date2DB($this->data['Vouchers10']['to_date']);
            }                                  
            if($this->Vouchers10->saveAll($this->data)){
                $this->request->data['Vouchers10']['id'] = $this->Vouchers10->id;
                $this->Flash->success('Voucher Details Saved Successfully !');
            }else{
                $this->Flash->error('Saving Failed !');
            }
        }
        /*
         *Code start for edit voucher10
         */  
        if(isset($this->data['editVoucher10Form']) && is_array($this->data['editVoucher10Form']) && count($this->data['editVoucher10Form'])>0){
            if(isset($this->data['editVoucher10Form']['id']) && (int)$this->data['editVoucher10Form']['id'] != 0){
                $this->Vouchers10->id = $this->data['editVoucher10Form']['id'];
                if($this->Vouchers10->exists($this->data['editVoucher10Form']['id'])){
                    $this->data = $this->Vouchers10->findById($this->data['editVoucher10Form']['id']);
                    unset($this->request->data['Vouchers10detail']);
                }else{
                    $this->Session->setFlash('Invalid Store.', 'default', array('class' => 'success'));
                }                
            }
        }        
        /*
         *Get list of accounts
         */
        $accountList = $this->Account->find('list', array(
            'conditions' => array(
                'is_enable' => 1, 
                'parent_id != ' => NULL
            ), 
            'order' => array(
                'title' => 'asc'
            ), 
        ));
        /*
         *Get financial year
         */        
        $fyear = $this->Financialyear->findById($this->Session->read('fyear'));
        $fyear = $fyear['Financialyear']['title'];
        $this->set(array(
            'title'             => 'Transit Permit (Form No.-10)',
            'fyear'             => $fyear,
            'default_date'      => date("d-m-Y"),
            'accountList'       => $accountList,
            'fyear_id'          => $this->Session->read('fyear'),
            'user_id'           => $this->Session->read('user_id'),
            'usertype_id'       => $this->Session->read('usertype_id'),
        ));  
    }
    /**
     * [voucher10Details description]
     * @return [type] [description]
     */
    public function voucher10Details(){
        $this->layout = 'ajax';
        $details = array();
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $this->loadModel('Vouchers10detail');
            $details = $this->Vouchers10detail->find('all',array(
                'recursive'     => -1,
                'conditions'    => array(
                    'Vouchers10detail.vouchers10_id'    => $this->data['id'],
                ),
            ));
        }
        $this->set(compact('details'));
    }
    /**
     * [voucher10DetailsDelete description]
     * @return [type] [description]
     */
    public function voucher10DetailsDelete(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $this->loadModel('Vouchers10detail');
            $this->Vouchers10detail->id = $this->data['id'];
            if($this->Vouchers10detail->exists()){
                if($this->Vouchers10detail->delete()){
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
     * [voucher10Delete description]
     * @return [type] [description]
     */
    public function voucher10Delete(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $this->loadModel('Vouchers10');
            $this->Vouchers10->id = $this->data['id'];
            if($this->Vouchers10->exists()){
                if($this->Vouchers10->delete()){
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
    public function addReport($id){
        $this->loadModel('Vouchers10Report');
        if(isset($this->data['Vouchers10Report']) && is_array($this->data['Vouchers10Report']) && count($this->data['Vouchers10Report'])>0){
            if($this->Vouchers10Report->save($this->data)){
                $this->Flash->success('Voucher Details Saved Successfully !');
                $this->redirect(array('action' => 'addReport',$id));
            }else{
                $this->Flash->error('Saving Failed !');
            }
        }
        $this->set(array(
            'title'     => 'Add Voucher 10 Report',
            'id'        => $id,
        ));
    } 
    public function voucher10ReportDetails(){
        $this->layout = 'ajax';
        $data = array();
        if(isset($this->data['vouchers10_id']) && (int)$this->data['vouchers10_id'] != 0){
            $this->loadModel('vouchers10Report');
            $data = $this->vouchers10Report->find('all',array(
                'recursive'     => -1,
                'conditions'    => array(
                    'vouchers10Report.vouchers10_id'    => $this->data['vouchers10_id'],
                ),
                'order'         => array(
                    'vouchers10Report.id'   => 'DESC',
                ),
            ));
        }
        $this->set(array(
            'data'      => $data,
        ));
    } 
    public function voucher10ReportDelete(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $this->loadModel('Vouchers10Report');
            $this->Vouchers10Report->id = $this->data['id'];
            if($this->Vouchers10Report->exists()){
                if($this->Vouchers10Report->delete()){
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
    public function voucher10Approve(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $fields = array();
            $curDate = date('Y-m-d H:i:s');
            $conds = array('Vouchers10.id' => $this->data['id']);
            if($this->Session->read('usertype_id') == Configure::read('DFOUSERTTYPE')){
                $fields = array(
                    'Vouchers10.is_approve_dfo'     => "'Y'",
                    'Vouchers10.approve_dfo_by'     => $this->Session->read('id'),
                    'Vouchers10.approve_dfo_date'   => "'$curDate'",
                );
            }else if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                $fields = array(
                    'Vouchers10.is_approve_accountant'      => "'Y'",
                    'Vouchers10.approve_accountant_by'      => $this->Session->read('id'),
                    'Vouchers10.approve_accountant_date'    => "'$curDate'",
                );
            }
            $this->loadModel('vouchers10');
            $this->Vouchers10->id = $this->data['id'];
            if($this->Vouchers10->exists()){
                if(is_array($fields) && count($fields)>0){
                    if($this->Vouchers10->updateAll($fields,$conds)){
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
    public function voucher10Reject(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $remarks = $this->data['remarks'];
            $fields = array();
            $conds = array('Vouchers10.id' => $this->data['id']);
            $curDate = date('Y-m-d H:i:s');
            if($this->Session->read('usertype_id') == Configure::read('DFOUSERTTYPE')){
                $fields = array(
                    'Vouchers10.is_reject_dfo'     => "'Y'",
                    'Vouchers10.reject_dfo_by'     => $this->Session->read('id'),
                    'Vouchers10.reject_dfo_date'   => "'$curDate'",
                    'Vouchers10.dfo_remark'        => "'$remarks'",
                );
            }else if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                $fields = array(
                    'Vouchers10.is_reject_accountant'      => "'Y'",
                    'Vouchers10.reject_accountant_by'      => $this->Session->read('id'),
                    'Vouchers10.reject_accountant_date'    => "'$curDate'",
                    'Vouchers10.accountant_remark'          => "'$remarks'",
                );
            }
            $this->loadModel('vouchers10');
            $this->Vouchers10->id = $this->data['id'];
            if($this->Vouchers10->exists()){
                if(is_array($fields) && count($fields)>0){
                    if($this->Vouchers10->updateAll($fields,$conds)){
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