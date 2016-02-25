<?php 
App::uses('AppController', 'Controller');

class PurchasesController extends AppController {
    public $components = array('Flash', 'Session');
    public $helpers = array('Html', 'Message', 'Form', 'Money');
    //public $uses=array('Purchasedetail');

    public $paginate = array('limit' => 25, 'order' => array('Purchase.id' => 'desc'));

    /**
     * After Filter Action
     */
    public function afterFilter() {
        $this->response->disableCache();
        if ($this->Session->read('user_id') == '') {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


        if ($this->Session->read('fyear') == '') {
            $this->redirect(array('controller' => 'selections', 'action' => 'index'));
        }

    }
    /**
     * Index Action
     */
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
            'title'         => 'Manage Daily KL Purchases',
            'roList'        => $roList,
            'dfoList'       => $dfoList,
            'usertype_id'   => $this->Session->read('usertype_id'),
            'fyear'         => $fyear,
            'hos'           => $hos,
        ));
    }
    public function indexAjax(){
        $this->layout   = 'ajax';
        $condition      = array();
        $ro_id          = 0;
        $dfo_id         = 0;
        $fyear          = 0;
        $account_id     = 0;
        $start_date     = '';
        $end_date       = '';
        $voucher_status = '';        
        $page           = 0;
        $this->loadModel('Purchase');
        if($this->Session->read('usertype_id') == Configure::read('ROUSERTTYPE')){
            $condition += array('Purchase.user_id'    => $this->Session->read('user_id'));
        }else if($this->Session->read('usertype_id') == Configure::read('DFOUSERTTYPE')){
            $condition += array('ViewDfoRo.dfo_id'    => $this->Session->read('id'));
        }else if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
            $condition += array('ViewDfoRo.accountant_id'    => $this->Session->read('id'));
        } 
        if(isset($this->params['named']['ro_id']) && (int)$this->params['named']['ro_id'] != 0){
            $ro_id   = $this->params['named']['ro_id'];
            $condition          += array('Purchase.user_id' => $ro_id);
        }
        if(isset($this->params['named']['dfo_id']) && (int)$this->params['named']['dfo_id'] != 0){
            $dfo_id   = $this->params['named']['dfo_id'];
            $condition          += array('ViewDfoRo.dfo_id' => $dfo_id);
        } 
        if(isset($this->params['named']['fyear']) && (int)$this->params['named']['fyear'] != 0){
            $fyear   = $this->params['named']['fyear'];
            $condition          += array('Purchase.financialyear_id' => $fyear);
        }
        if(isset($this->params['named']['account_id']) && (int)$this->params['named']['account_id'] != 0){
            $account_id   = $this->params['named']['account_id'];
            $condition          += array('Purchase.account_id' => $account_id);
        } 
        if(isset($this->params['named']['start_date']) && $this->params['named']['start_date'] != ''){
            $start_date   = $this->params['named']['start_date'];
            $condition          += array('Purchase.edate >=' => $this->date2DB($start_date));
        } 
        if(isset($this->params['named']['end_date']) && $this->params['named']['end_date'] != ''){
            $end_date   = $this->params['named']['end_date'];
            $condition          += array('Purchase.edate <=' => $this->date2DB($end_date));
        }
        if(isset($this->params['named']['voucher_status']) && $this->params['named']['voucher_status'] != ''){
            $voucher_status   = $this->params['named']['voucher_status'];
            if($voucher_status == 'A'){
                if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                    $condition          += array('Purchase.is_approve_accountant' => 'Y');
                }else{
                    $condition          += array('Purchase.is_approve_dfo' => 'Y');
                }
            }else if($voucher_status == 'R'){
                if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                    $condition          += array('Purchase.is_reject_accountant' => 'Y');
                }else{
                    $condition          += array('Purchase.is_reject_dfo' => 'Y');
                }
            }else if($voucher_status == 'P'){
                if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                    $condition          += array('Purchase.is_approve_accountant' => 'N','Purchase.is_reject_accountant' => 'N');
                }else{
                    $condition          += array('Purchase.is_approve_dfo' => 'N','Purchase.is_reject_dfo' => 'N');
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
                $this->set('file_name','purcahse_list'.time().date('d_m_Y').'.xls');
            }else if($this->params['named']['reqType']=='DOC'){
                $this->set('file_type','doc');
                $this->set('file_name','purcahse_list'.time().date('d_m_Y').'.doc');
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
                        'Purchase.user_id = ViewDfoRo.ro_user_id'
                    )
                )                
            ),
            'conditions'=> $condition, 
            'order' => array('Purchase.id' => 'DESC')
        )+$limit;
        $purchases = $this->paginate('Purchase');
        $this->set(array(
            'purchases'         => $purchases,
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
    public function purchaseDetails(){
        $this->layout = 'ajax';
        $details = array();
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $this->loadModel('Purchasedetail');
            $details = $this->Purchasedetail->find('all',array(
                //'recursive'     => -1,
                'conditions'    => array(
                    'Purchasedetail.purchase_id'    => $this->data['id'],
                ),
            ));
        }
        $this->set(compact('details'));        
    } 
    public function view($id){
        $title = 'View Daily KL Purchases';
        $data = array();
        if($id){
            $this->loadModel('Purchase');
            $data = $this->Purchase->find('first',array(
                'recursive'     => 2,
                'conditions'    => array(
                    'Purchase.id'     => $id,
                ),
            ));
        }
        $this->set(array(
            'data'              => $data,
            'title'             => $title,
            'usertype_id'       => $this->Session->read('usertype_id'),
        ));        
    } 
    /**
     * Add Action
     */
    public function add() {
        $this->loadModel('Worker');
        $this->loadModel('Purchase');
        $this->loadModel('Purchasedetail');
        if(isset($this->data['Purchase']) && is_array($this->data['Purchase']) && count($this->data['Purchase'])>0){
            if(isset($this->data['Purchase']['edate']) && $this->data['Purchase']['edate'] != ''){
                $this->request->data['Purchase']['edate'] = $this->date2DB($this->data['Purchase']['edate']);
            }
            if(isset($this->data['Purchase']['id']) && (int)$this->data['Purchase']['id'] != 0){
                if(isset($this->data['Purchasedetail'][0]['worker_id']) && (int)$this->data['Purchasedetail'][0]['worker_id'] != 0){
                    $detailData = $this->Purchasedetail->find('first',array(
                        'recursive'     => -1,
                        'fields'        => array(
                            'Purchasedetail.id'
                        ),
                        'conditions'    => array(
                            'Purchasedetail.purchase_id'    => $this->data['Purchase']['id'], 
                            'Purchasedetail.worker_id'      => $this->data['Purchasedetail'][0]['worker_id']
                        ),
                    ));
                    if(isset($detailData['Purchasedetail']['id']) && (int)$detailData['Purchasedetail']['id'] != 0){
                        $this->request->data['Purchasedetail'][0]['id'] = $detailData['Purchasedetail']['id'];
                    }
                }
            }
            $this->request->data['Purchasedetail'][0]['user_id'] = $this->data['Purchase']['user_id'];
            if($this->Purchase->saveAll($this->data)){
                $this->request->data['Purchase']['id'] = $this->Purchase->id;
                $this->Flash->success('Daily KL Purchase Added Successfully !');
            }else{
                $this->Flash->error('Saving Failed !');
            }
        }
        /*
         *Code start for edit voucher2b
         */  
        if(isset($this->data['editPurchaseForm']) && is_array($this->data['editPurchaseForm']) && count($this->data['editPurchaseForm'])>0){
            if(isset($this->data['editPurchaseForm']['id']) && (int)$this->data['editPurchaseForm']['id'] != 0){
                $this->Purchase->id = $this->data['editPurchaseForm']['id'];
                if($this->Purchase->exists($this->data['editPurchaseForm']['id'])){
                    $this->data = $this->Purchase->findById($this->data['editPurchaseForm']['id']);
                    unset($this->request->data['Purchasedetail']);
                }else{
                    $this->Session->setFlash('Invalid Store.', 'default', array('class' => 'success'));
                }                
            }
        }          
        $workers = $this->Worker->find('list', array(
            'conditions'    => array(
                'ro_id'     => $this->Session->read('id'), 
                'is_enable' => 1
            ), 
            'order' => array('title' => 'asc'), 
        ));
        $this->set(array(
            'title'             => 'Add Daily KL Purchase',
            'workers'           => $workers,
            'ro_id'             => $this->Session->read('id'),
            'user_id'           => $this->Session->read('user_id'),
            'financialyear_id'  => $this->Session->read('fyear'),
            'account_id'        => $this->Session->read('hos'),  
            'usertype_id'       => $this->Session->read('usertype_id'),          
        ));
    }

    /**
     * Delete Action
     */

    public function delete($id) {
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $this->loadModel('Purchase');
            $this->Purchase->id = $this->data['id'];
            if($this->Purchase->exists()){
                if($this->Purchase->delete()){
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
     * Deleteitem Action
     */

    public function deleteitem() {
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $this->loadModel('Purchasedetail');
            $this->Purchasedetail->id = $this->data['id'];
            if($this->Purchasedetail->exists()){
                if($this->Purchasedetail->delete()){
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
     * [purchaseklApprove description]
     * @return [type] [description]
     */
    public function purchaseklApprove(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $fields = array();
            $curDate = date('Y-m-d H:i:s');
            $conds = array('Purchase.id' => $this->data['id']);
            if($this->Session->read('usertype_id') == Configure::read('DFOUSERTTYPE')){
                $fields = array(
                    'Purchase.is_approve_dfo'     => "'Y'",
                    'Purchase.approve_dfo_by'     => $this->Session->read('id'),
                    'Purchase.approve_dfo_date'   => "'$curDate'",
                );
            }else if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                $fields = array(
                    'Purchase.is_approve_accountant'      => "'Y'",
                    'Purchase.approve_accountant_by'      => $this->Session->read('id'),
                    'Purchase.approve_accountant_date'    => "'$curDate'",
                );
            }
            $this->loadModel('Purchase');
            $this->Purchase->id = $this->data['id'];
            if($this->Purchase->exists()){
                if(is_array($fields) && count($fields)>0){
                    if($this->Purchase->updateAll($fields,$conds)){
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
     * [purchaseklReject description]
     * @return [type] [description]
     */
    public function purchaseklReject(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $remarks = $this->data['remarks'];
            $fields = array();
            $conds = array('Purchase.id' => $this->data['id']);
            $curDate = date('Y-m-d H:i:s');
            if($this->Session->read('usertype_id') == Configure::read('DFOUSERTTYPE')){
                $fields = array(
                    'Purchase.is_reject_dfo'     => "'Y'",
                    'Purchase.reject_dfo_by'     => $this->Session->read('id'),
                    'Purchase.reject_dfo_date'   => "'$curDate'",
                    'Purchase.dfo_remark'        => "'$remarks'",
                );
            }else if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                $fields = array(
                    'Purchase.is_reject_accountant'      => "'Y'",
                    'Purchase.reject_accountant_by'      => $this->Session->read('id'),
                    'Purchase.reject_accountant_date'    => "'$curDate'",
                    'Purchase.accountant_remark'         => "'$remarks'",
                );
            }
            $this->loadModel('Purchase');
            $this->Purchase->id = $this->data['id'];
            if($this->Purchase->exists()){
                if(is_array($fields) && count($fields)>0){
                    if($this->Purchase->updateAll($fields,$conds)){
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