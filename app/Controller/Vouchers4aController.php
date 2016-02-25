<?php 
App::uses('AppController', 'Controller');

class Vouchers4aController extends AppController {
    public $components = array('Flash', 'Session', 'Paginator');
    public $helpers = array('Html', 'Message', 'Form', 'Money');
    public $uses = array('Vouchers4a', 'Vouchers4adetail');
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
            'dfoList'       => $dfoList,
            'roList'        => $roList,
            'title'         => 'Vouchers 4(a) List',
            'usertype_id'   => $this->Session->read('usertype_id'),
            'fyear'         => $fyear,
            'hos'           => $hos,            
        ));
    }
    public function indexAjax() {
        $this->layout   = 'ajax'; 
        $condition      = array();
        $ro_id          = 0;
        $dfo_id         = 0;
        $page           = 0;
        $fyear          = 0;
        $account_id     = 0;
        $start_date     = '';
        $end_date       = '';
        $voucher_status = '';        
        if($this->Session->read('usertype_id') == Configure::read('ROUSERTTYPE')){
            $condition += array('Vouchers4a.user_id'    => $this->Session->read('user_id'));
        }else if($this->Session->read('usertype_id') == Configure::read('DFOUSERTTYPE')){
            $condition += array('ViewDfoRo.dfo_id'    => $this->Session->read('id'));
        }else if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
            $condition += array('ViewDfoRo.accountant_id'    => $this->Session->read('id'));
        }       
        if(isset($this->params['named']['ro_id']) && (int)$this->params['named']['ro_id'] != 0){
            $ro_id   = $this->params['named']['ro_id'];
            $condition          += array('Vouchers4a.user_id' => $ro_id);
        }
        if(isset($this->params['named']['dfo_id']) && (int)$this->params['named']['dfo_id'] != 0){
            $dfo_id   = $this->params['named']['dfo_id'];
            $condition          += array('ViewDfoRo.dfo_id' => $dfo_id);
        } 
        if(isset($this->params['named']['fyear']) && (int)$this->params['named']['fyear'] != 0){
            $fyear   = $this->params['named']['fyear'];
            $condition          += array('Vouchers4a.financialyear_id' => $fyear);
        }
        if(isset($this->params['named']['account_id']) && (int)$this->params['named']['account_id'] != 0){
            $account_id   = $this->params['named']['account_id'];
            $condition          += array('Vouchers4a.account_id' => $account_id);
        } 
        if(isset($this->params['named']['start_date']) && $this->params['named']['start_date'] != ''){
            $start_date   = $this->params['named']['start_date'];
            $condition          += array('Vouchers4a.edate >=' => $this->date2DB($start_date));
        } 
        if(isset($this->params['named']['end_date']) && $this->params['named']['end_date'] != ''){
            $end_date   = $this->params['named']['end_date'];
            $condition          += array('Vouchers4a.edate <=' => $this->date2DB($end_date));
        }
        if(isset($this->params['named']['voucher_status']) && $this->params['named']['voucher_status'] != ''){
            $voucher_status   = $this->params['named']['voucher_status'];
            if($voucher_status == 'A'){
                if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                    $condition          += array('Vouchers4a.is_approve_accountant' => 'Y');
                }else{
                    $condition          += array('Vouchers4a.is_approve_dfo' => 'Y');
                }
            }else if($voucher_status == 'R'){
                if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                    $condition          += array('Vouchers4a.is_reject_accountant' => 'Y');
                }else{
                    $condition          += array('Vouchers4a.is_reject_dfo' => 'Y');
                }
            }else if($voucher_status == 'P'){
                if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                    $condition          += array('Vouchers4a.is_approve_accountant' => 'N','Vouchers4a.is_reject_accountant' => 'N');
                }else{
                    $condition          += array('Vouchers4a.is_approve_dfo' => 'N','Vouchers4a.is_reject_dfo' => 'N');
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
                $this->set('file_name','voucher4a_list'.time().date('d_m_Y').'.xls');
            }else if($this->params['named']['reqType']=='DOC'){
                $this->set('file_type','doc');
                $this->set('file_name','voucher4a_list'.time().date('d_m_Y').'.doc');
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
                        'Vouchers4a.user_id = ViewDfoRo.ro_user_id'
                    )
                )                
            ),
            'conditions'=> $condition, 
            'order' => array('code' => 'desc')
        )+$limit;
        $vouchers = $this->paginate('Vouchers4a');
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
    /*Add Action*/
    public function add() {
        $is_enable = array('0' => 'No', '1' => 'Yes');
        if(isset($this->data['Vouchers4a']) && is_array($this->data['Vouchers4a']) && count($this->data['Vouchers4a'])>0){
            $this->request->data['Vouchers4a']['user_id'] = $this->Session->read('user_id');
            $this->request->data['Vouchers4a']['financialyear_id'] = $this->Session->read('fyear');
            $this->request->data['Vouchers4a']['account_id'] = $this->Session->read('hos');
            if(isset($this->request->data['Vouchers4a']['edate']) && $this->request->data['Vouchers4a']['edate'] != ''){
                $this->request->data['Vouchers4a']['edate'] = $this->date2DB($this->request->data['Vouchers4a']['edate']);
            }
            if(isset($this->data['Vouchers4adetail']) && is_array($this->data['Vouchers4adetail']) && count($this->data['Vouchers4adetail'])>0){
                foreach ($this->data['Vouchers4adetail'] as $vouDetailKey => $vouDetailKValue) {
                    $this->request->data['Vouchers4adetail'][$vouDetailKey]['user_id'] = $this->Session->read('user_id');
                }
            }           
            if($this->Vouchers4a->saveAll($this->data)){
                $this->request->data['Vouchers4a']['id'] = $this->Vouchers4a->id;
                $this->Flash->success("Saved Successfully !");
            }else{
                $this->Flash->error("Saving Failed");
            }
        }

        /*
         *Code start for edit voucher10
         */  
        if(isset($this->data['editVoucher4aForm']) && is_array($this->data['editVoucher4aForm']) && count($this->data['editVoucher4aForm'])>0){
            if(isset($this->data['editVoucher4aForm']['id']) && (int)$this->data['editVoucher4aForm']['id'] != 0){
                $this->Vouchers4a->id = $this->data['editVoucher4aForm']['id'];
                if($this->Vouchers4a->exists($this->data['editVoucher4aForm']['id'])){
                    $this->data = $this->Vouchers4a->findById($this->data['editVoucher4aForm']['id']);
                    unset($this->request->data['Vouchers10detail']);
                }else{
                    $this->Session->setFlash('Invalid request.', 'default', array('class' => 'success'));
                }                
            }
        }
        $this->set(array(
            'title'         => 'Add Voucher 4(a)',
            'usertype_id'   => $this->Session->read('usertype_id'),
        ));  
    }

    public function voucher4aDetails(){
        $this->layout = 'ajax';
        $details = array();
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $this->loadModel('Vouchers4adetail');
            $details = $this->Vouchers4adetail->find('all',array(
                'recursive'     => -1,
                'conditions'    => array(
                    'Vouchers4adetail.vouchers4a_id'    => $this->data['id'],
                ),
            ));
        }
        $this->set(compact('details'));
    }
   
    public function voucher4aDetailsDelete(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $this->loadModel('Vouchers4adetail');
            $this->Vouchers4adetail->id = $this->data['id'];
            if($this->Vouchers4adetail->exists()){
                if($this->Vouchers4adetail->delete()){
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

    /*Delete Action*/
    public function delete($id) {
        $this->Vouchers4a->id = $id;
        $this->Vouchers4a->delete();
        $this->Vouchers4a->query("delete from vouchers4adetails where vouchers4a_id='".$id."'");
        $this->Flash->success("Deleted Successfully !");
        $this->redirect(array('controller' => 'vouchers4a', 'action' => 'index'));
    }

    public function voucher4aDelete(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $this->loadModel('Vouchers4a');
            $this->Vouchers4a->id = $this->data['id'];
            if($this->Vouchers4a->exists()){
                if($this->Vouchers4a->delete()){
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

    /*View Action*/
    public function view($id){
        $this->request->data = $this->Vouchers4a->findById($id);
        $this->set(array(
            'title'             => 'ViewVOucher 4(a)',
            'usertype_id'       => $this->Session->read('usertype_id'),
        ));
    }
    
    /*addreport action*/
    
    public function addreport($id){
        $this->loadModel('Vouchers4aReport');
        /*
         *Save the voucher 4a report
         */
        if(isset($this->data['Vouchers4aReport']) && is_array($this->data['Vouchers4aReport']) && count($this->data['Vouchers4aReport'])>0){
            if($this->Vouchers4aReport->save($this->data)){
                $this->Flash->success("Saved Successfully !");
                $this->redirect(array('controller' => 'vouchers4a', 'action' => 'index', ));
            }else{
                $this->Flash->error("Saving Failed !");
            }
        }
        /*
         *Code for get the 
         */
        if($id){
            $this->data = $this->Vouchers4aReport->find('first',array(
                'recursive'     => -1,
                'conditions'    => array(
                    'Vouchers4aReport.vouchers4a_id'    => $id,
                ),
            ));
        }
        $this->set(array(
            'title'     => 'Add Binding Report',
            'id'        => $id,
        ));
    }
    public function voucher4aApprove(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $fields = array();
            $curDate = date('Y-m-d H:i:s');
            $conds = array('Vouchers4a.id' => $this->data['id']);
            if($this->Session->read('usertype_id') == Configure::read('DFOUSERTTYPE')){
                $fields = array(
                    'Vouchers4a.is_approve_dfo'     => "'Y'",
                    'Vouchers4a.approve_dfo_by'     => $this->Session->read('id'),
                    'Vouchers4a.approve_dfo_date'   => "'$curDate'",
                );
            }else if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                $fields = array(
                    'Vouchers4a.is_approve_accountant'      => "'Y'",
                    'Vouchers4a.approve_accountant_by'      => $this->Session->read('id'),
                    'Vouchers4a.approve_accountant_date'    => "'$curDate'",
                );
            }
            $this->loadModel('Vouchers4a');
            $this->Vouchers4a->id = $this->data['id'];
            if($this->Vouchers4a->exists()){
                if(is_array($fields) && count($fields)>0){
                    if($this->Vouchers4a->updateAll($fields,$conds)){
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
    public function voucher4aReject(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $remarks = $this->data['remarks'];
            $fields = array();
            $conds = array('Vouchers4a.id' => $this->data['id']);
            $curDate = date('Y-m-d H:i:s');
            if($this->Session->read('usertype_id') == Configure::read('DFOUSERTTYPE')){
                $fields = array(
                    'Vouchers4a.is_reject_dfo'     => "'Y'",
                    'Vouchers4a.reject_dfo_by'     => $this->Session->read('id'),
                    'Vouchers4a.reject_dfo_date'   => "'$curDate'",
                    'Vouchers4a.dfo_remark'        => "'$remarks'",
                );
            }else if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                $fields = array(
                    'Vouchers4a.is_reject_accountant'      => "'Y'",
                    'Vouchers4a.reject_accountant_by'      => $this->Session->read('id'),
                    'Vouchers4a.reject_accountant_date'    => "'$curDate'",
                    'Vouchers4a.accountant_remark'         => "'$remarks'",
                );
            }
            $this->loadModel('Vouchers4a');
            $this->Vouchers4a->id = $this->data['id'];
            if($this->Vouchers4a->exists()){
                if(is_array($fields) && count($fields)>0){
                    if($this->Vouchers4a->updateAll($fields,$conds)){
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