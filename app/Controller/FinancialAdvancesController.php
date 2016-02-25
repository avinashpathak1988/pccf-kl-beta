<?php 
App::uses('AppController', 'Controller');

class FinancialAdvancesController extends AppController {
    public $uses = array('FinancialAdvance', 'Account', 'Financialyear', 'VouchersfasAttachment','Admin');
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
            'conditions' => array('is_enable' => 1, 'parent_id IS NULL'), 
            'order' => array('title' => 'asc'), 
        ));        
        $this->set(array(
            'dfoList'       => $dfoList,
            'roList'        => $roList,
            'title'         => 'FA List',
            'usertype_id'   => $this->Session->read('usertype_id'),
            'account_id'    => $this->Session->read('hos'),
            'fyear_id'      => $this->Session->read('fyear'),
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
        $advance_status = '';
        $condition      = array();
        
        if(isset($this->params['named']['fyear']) && (int)$this->params['named']['fyear'] != 0){
            $fyear   = $this->params['named']['fyear'];
            $condition          += array('FinancialAdvance.fyear' => $fyear);
        }
        if(isset($this->params['named']['account_id']) && (int)$this->params['named']['account_id'] != 0){
            $account_id   = $this->params['named']['account_id'];
            $condition          += array('FinancialAdvance.account_id' => $account_id);
        } 
        if(isset($this->params['named']['start_date']) && $this->params['named']['start_date'] != ''){
            $start_date   = $this->params['named']['start_date'];
            $condition          += array('FinancialAdvance.fa_date >=' => $this->date2DB($start_date));
        } 
        if(isset($this->params['named']['end_date']) && $this->params['named']['end_date'] != ''){
            $end_date   = $this->params['named']['end_date'];
            $condition          += array('FinancialAdvance.fa_date <=' => $this->date2DB($end_date));
        }
                                    
        if(isset($this->params['named']['page']) && $this->params['named']['page'] != ''){
            $page   = $this->params['named']['page'];
        }
        if(isset($this->params['named']['advance_status']) && $this->params['named']['advance_status'] != ''){
            $advance_status   = $this->params['named']['advance_status'];
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
        
        $advanceTaken = array();
        $conditionGiven = array();
        $conditionTaken = array();
        if($this->Session->read('usertype_id') == Configure::read('ROUSERTTYPE')){
            $conditionGiven          += array("FinancialAdvance.created_by"   => $this->Session->read('id'),"FinancialAdvance.usertype_id"   => $this->Session->read('usertype_id'));
            $roAdvance = $this->FinancialAdvance->find("first", array(
                "conditions"    => $condition+$conditionGiven,
                "fields"        => array(
                    "sum(amount) as total_advance",
                ),
            ));
            $balance = $roAdvance[0]['total_advance'] - 0;
            $advanceTaken = array(
                    "advance_taken"     => $roAdvance[0]['total_advance'],
                    "advance_given"     => 0,
                    "balance"           => $balance,
                );
        }
        if($this->Session->read('usertype_id') == Configure::read('DFOUSERTTYPE')){
            if($advance_status == 'Taken'){
                $condition          += array("FinancialAdvance.created_by"   => $this->Session->read('id'),"FinancialAdvance.usertype_id"   => $this->Session->read('usertype_id'));
            }
            if($advance_status == 'Given'){
                $conditionGiven          += array(
                            "FinancialAdvance.from_user_id"   => $this->Session->read('id'),
                            "FinancialAdvance.from_usertype_id"   => $this->Session->read('usertype_id'),
                        );
                if(isset($this->params['named']['ro_id']) && $this->params['named']['ro_id'] != ''){   
                    $ro_id      = $this->params['named']['ro_id'];                
                    $conditionGiven          += array(
                            "FinancialAdvance.user_id"   => $this->params['named']['ro_id'],
                            "FinancialAdvance.usertype_id"   => Configure::read('ROUSERTTYPE')
                        );
                }
            }
            $dfoAdvanceTaken = $this->FinancialAdvance->find("first", array(
                "conditions"    => $condition+array("FinancialAdvance.created_by"   => $this->Session->read('id'),"FinancialAdvance.usertype_id"   => $this->Session->read('usertype_id')),
                "fields"        => array(
                    "sum(amount) as total_advance",
                ),
            ));
            $dfoAdvanceGiven = $this->FinancialAdvance->find("first", array(
                "conditions"    => array(
                        "FinancialAdvance.from_user_id" => $this->Session->read('id'),
                        "FinancialAdvance.from_usertype_id" => $this->Session->read('usertype_id'),
                    ),
                "fields"        => array(
                    "sum(amount) as total_advance_given",
                ),
            ));
            $balance = $dfoAdvanceTaken[0]['total_advance'] - $dfoAdvanceGiven[0]['total_advance_given'];
            $advanceTaken = array(
                    "advance_taken"     => $dfoAdvanceTaken[0]['total_advance'],
                    "advance_given"     => $dfoAdvanceGiven[0]['total_advance_given'],
                    "balance"           => $balance,
                );
        }
        if($this->Session->read('usertype_id') == Configure::read('PCCFUSERTTYPE')){
            if(isset($this->params['named']['ro_id']) && $this->params['named']['ro_id'] != ''){   
                $conditionGiven          += array(
                        "FinancialAdvance.from_user_id"   => $this->params['named']['dfo_id'],
                        "FinancialAdvance.from_usertype_id"   => Configure::read('DFOUSERTTYPE'),
                    );
                $ro_id      = $this->params['named']['ro_id'];                
                $conditionGiven          += array(
                        "FinancialAdvance.user_id"   => $this->params['named']['ro_id'],
                        "FinancialAdvance.usertype_id"   => Configure::read('ROUSERTTYPE')
                    );
            }else{
                $conditionGiven          += array(
                        "FinancialAdvance.from_user_id"   => $this->Session->read('id'),
                        "FinancialAdvance.from_usertype_id"   => $this->Session->read('usertype_id'),
                    );
            }
            if(isset($this->params['named']['dfo_id']) && $this->params['named']['dfo_id'] != '' && isset($this->params['named']['ro_id']) && $this->params['named']['ro_id'] == ''){   
                $dfo_id      = $this->params['named']['dfo_id'];                
                $conditionGiven          += array(
                        "FinancialAdvance.created_by"   => $this->params['named']['dfo_id'],
                        "FinancialAdvance.usertype_id"   => Configure::read('DFOUSERTTYPE')
                    );
            }
            
            $dfoAdvanceGiven = $this->FinancialAdvance->find("first", array(
                "conditions"    => array(
                        "FinancialAdvance.from_user_id" => $this->Session->read('id'),
                        "FinancialAdvance.from_usertype_id" => $this->Session->read('usertype_id'),
                    ),
                "fields"        => array(
                    "sum(amount) as total_advance_given",
                ),
            ));
            
            $advanceTaken = array(
                    "advance_taken"     => 0,
                    "advance_given"     => $dfoAdvanceGiven[0]['total_advance_given'],
                    "balance"           => 0,
                );
        }        
        $this->paginate = array(              
            'conditions' => $condition+$conditionGiven, 
            'order' => array('FinancialAdvance.fa_date' => 'desc')
        )+$limit;

        $this->set(array(
            'financial_advance' => $this->paginate('FinancialAdvance'),
            'usertype_id'       => $this->Session->read('usertype_id'),
            'ro_id'             => $ro_id,
            'dfo_id'            => $dfo_id,   
            'page'              => $page,   
            'fyear'             => $fyear, 
            'account_id'        => $account_id,  
            'start_date'        => $start_date, 
            'end_date'          => $end_date,
            'advanceTaken'      => $advanceTaken,
            'advance_status'    => $advance_status,
        ));
    }    
    public function add() {
        $this->response->disableCache();
        $this->loadModel('ViewDfoRo');
        $dfoBalance = 0;
        if (isset($this->data['FinancialAdvance']) && is_array($this->data['FinancialAdvance']) && count($this->data['FinancialAdvance'])>0) {
            $this->request->data['FinancialAdvance']['user_id']         = $this->Session->read('user_id');
            $this->request->data['FinancialAdvance']['created_by']      = $this->Session->read('id');
            $this->request->data['FinancialAdvance']['usertype_id']     = $this->Session->read('usertype_id');
            $this->request->data['FinancialAdvance']['fyear']           = $this->Session->read('fyear');
            $this->request->data['FinancialAdvance']['account_id']      = $this->Session->read('hos');
            if(isset($this->data['FinancialAdvance']['fa_date']) && $this->data['FinancialAdvance']['fa_date'] != ''){
                $this->request->data['FinancialAdvance']['fa_date']     = $this->date2DB($this->data['FinancialAdvance']['fa_date']);
            }
            if($this->FinancialAdvance->saveAll($this->request->data)) {
                $this->request->data['FinancialAdvance']['id'] = $this->FinancialAdvance->id;
                $this->Flash->success('Advance Details Saved Successfully !');
                $this->redirect(array('controller' => 'FinancialAdvances', 'action' => 'index'));
            }else{
                $this->Flash->error('Saving Failed !');
            }
        }
        /*
         *Code start for edit finacial advance
         */  
        if(isset($this->data['editFinancialAdvanceForm']) && is_array($this->data['editFinancialAdvanceForm']) && count($this->data['editFinancialAdvanceForm'])>0){
            if(isset($this->data['editFinancialAdvanceForm']['id']) && (int)$this->data['editFinancialAdvanceForm']['id'] != 0){
                $this->FinancialAdvance->id = $this->data['editFinancialAdvanceForm']['id'];
                if($this->FinancialAdvance->exists($this->data['editFinancialAdvanceForm']['id'])){
                    $this->data = $this->FinancialAdvance->findById($this->data['editFinancialAdvanceForm']['id']);
                }else{
                    $this->Session->setFlash('Invalid Store.', 'default', array('class' => 'success'));
                }                
            }
        }         
        /*
         *Query for get list of head of service
         */
        $hosList = $this->Account->find('list',array(
            'recursive'     => -1,
            'conditions'    => array(
                'Account.parent_id' => $this->Session->read('hos'),
            ),
            'fields'        => array(
                'Account.id',
                'Account.title',
            ),
        ));
        $account_id = $this->Session->read('hos');
        $fyear          = $this->Financialyear->findById($this->Session->read('fyear'));
        $financialYear  = $fyear['Financialyear']['title']; 
        $accountArr     = $this->Account->findById($this->Session->read('hos'));  
        $account        = $accountArr['Account']['title'];  
        
        $fromUserDetails = array();
        $advanceCondition = array(
                "FinancialAdvance.fyear"        => $this->Session->read('fyear'),
                "FinancialAdvance.account_id"   => $this->Session->read('hos'),
            );
        if($this->Session->read('usertype_id') == Configure::read('ROUSERTTYPE')){
            $dfoAdvanceTaken = $this->FinancialAdvance->find("first", array(
                "conditions"    => $advanceCondition+array("FinancialAdvance.created_by"   => $this->Session->read('dfo_id'),"FinancialAdvance.usertype_id"   => Configure::read('DFOUSERTTYPE')),
                "fields"        => array(
                    "sum(amount) as total_advance",
                ),
            ));
            $dfoAdvanceGiven = $this->FinancialAdvance->find("first", array(
                "conditions"    => array(
                        "FinancialAdvance.from_user_id" => $this->Session->read('dfo_id'),
                        "FinancialAdvance.from_usertype_id" => Configure::read('DFOUSERTTYPE'),
                    )+$advanceCondition,
                "fields"        => array(
                    "sum(amount) as total_advance_given",
                ),
            ));
            $dfoBalance = $dfoAdvanceTaken[0]['total_advance'] - $dfoAdvanceGiven[0]['total_advance_given'];
            $dfoDetails = $this->ViewDfoRo->find('first', array(
                'conditions' => array(
                    'ro_id' => $this->Session->read('id'),
                ), 
                'fields'    => array(
                    "ViewDfoRo.dfo_id",
                    "ViewDfoRo.dfo_title",
                ),
            ));
            $fromUserDetails = array('from_name'=>$dfoDetails['ViewDfoRo']['dfo_title'],'from_user_id'=>$dfoDetails['ViewDfoRo']['dfo_id'],'from_usertype_id'=>Configure::read('DFOUSERTTYPE'));
        }
        if($this->Session->read('usertype_id') == Configure::read('DFOUSERTTYPE')){
            $pccfDetails = $this->Admin->find('first', array(
                'conditions' => array(
                    'usertype_id    ' => Configure::read('PCCFUSERTTYPE'),
                ), 
                'fields'    => array(
                    "Admin.id",
                    "Admin.title",
                ),
            ));
            $fromUserDetails = array('from_name'=>$pccfDetails['Admin']['title'],'from_user_id'=>$pccfDetails['Admin']['id'],'from_usertype_id'=>Configure::read('PCCFUSERTTYPE'));
        }
        $fyear = $this->Financialyear->findById($this->Session->read('fyear'));
        $fyear = $fyear['Financialyear']['title'];
        $this->set(array(
            'title'         => 'Forest Advance',
            'account_id'    => $account_id,
            'fyear'         => $fyear,
            'default_date'  => date("d-m-Y"),
            'financialYear' => $financialYear,
            'account_id'    => $this->Session->read('hos'),
            'account'       => $account,
            'fromUserDetails' => $fromUserDetails,
            'hosList'       => $hosList,
            'usertype_id'   => $this->Session->read('usertype_id'),
            'dfoBalance'    => $dfoBalance,
        ));
    }
    /**
     * View Action
     */
    public function view($id) {
        $voucher_number = null;
        $data = $this->FinancialAdvance->findById($id);
        $this->set(array(
            'usertype_id'       => $this->Session->read('usertype_id'),
            'financial_advance'           => $data,
            'title'         => 'FA Details',
        ));
    }
    /**
     * Delete Action
     */
    public function financialAdvancesDelete(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $this->FinancialAdvance->id = $this->data['id'];
            if($this->FinancialAdvance->exists()){
                if($this->FinancialAdvance->delete()){
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