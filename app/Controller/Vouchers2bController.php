<?php 
App::uses('AppController', 'Controller');

class Vouchers2bController extends AppController {
    public $components = array('Flash', 'Session');
    public $helpers = array('Html', 'Message', 'Form', 'Money');
    public $uses = array('Vouchers2b', 'Vouchers2bdetail');
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
            'title'         => 'Vouchers 2(B) List',
            'usertype_id'   => $this->Session->read('usertype_id'),
            'fyear'         => $fyear,
            'hos'           => $hos,               
        ));
    }
    public function indexAjax(){
        $this->layout   = 'ajax';
        $this->loadModel('Vouchers2b');
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
            $condition += array('Vouchers2b.user_id'    => $this->Session->read('user_id'));
        }else if($this->Session->read('usertype_id') == Configure::read('DFOUSERTTYPE')){
            $condition += array('ViewDfoRo.dfo_id'    => $this->Session->read('id'));
        }else if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
            $condition += array('ViewDfoRo.accountant_id'    => $this->Session->read('id'));
        }  
        if(isset($this->params['named']['ro_id']) && (int)$this->params['named']['ro_id'] != 0){
            $ro_id   = $this->params['named']['ro_id'];
            $condition          += array('Vouchers2b.user_id' => $ro_id);
        }
        if(isset($this->params['named']['dfo_id']) && (int)$this->params['named']['dfo_id'] != 0){
            $dfo_id   = $this->params['named']['dfo_id'];
            $condition          += array('ViewDfoRo.dfo_id' => $dfo_id);
        } 
        if(isset($this->params['named']['fyear']) && (int)$this->params['named']['fyear'] != 0){
            $fyear   = $this->params['named']['fyear'];
            $condition          += array('Vouchers2b.fyear' => $fyear);
        }
        if(isset($this->params['named']['account_id']) && (int)$this->params['named']['account_id'] != 0){
            $account_id   = $this->params['named']['account_id'];
            $condition          += array('Vouchers2b.account_id' => $account_id);
        } 
        if(isset($this->params['named']['start_date']) && $this->params['named']['start_date'] != ''){
            $start_date   = $this->params['named']['start_date'];
            $condition          += array('Vouchers2b.voucher_date >=' => $this->date2DB($start_date));
        } 
        if(isset($this->params['named']['end_date']) && $this->params['named']['end_date'] != ''){
            $end_date   = $this->params['named']['end_date'];
            $condition          += array('Vouchers2b.voucher_date <=' => $this->date2DB($end_date));
        }
        if(isset($this->params['named']['voucher_status']) && $this->params['named']['voucher_status'] != ''){
            $voucher_status   = $this->params['named']['voucher_status'];
            if($voucher_status == 'A'){
                if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                    $condition          += array('Vouchers2b.is_approve_accountant' => 'Y');
                }else{
                    $condition          += array('Vouchers2b.is_approve_dfo' => 'Y');
                }
            }else if($voucher_status == 'R'){
                if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                    $condition          += array('Vouchers2b.is_reject_accountant' => 'Y');
                }else{
                    $condition          += array('Vouchers2b.is_reject_dfo' => 'Y');
                }
            }else if($voucher_status == 'P'){
                if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                    $condition          += array('Vouchers2b.is_approve_accountant' => 'N','Vouchers2b.is_reject_accountant' => 'N');
                }else{
                    $condition          += array('Vouchers2b.is_approve_dfo' => 'N','Vouchers2b.is_reject_dfo' => 'N');
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
                $this->set('file_name','voucher2b_list'.time().date('d_m_Y').'.xls');
            }else if($this->params['named']['reqType']=='DOC'){
                $this->set('file_type','doc');
                $this->set('file_name','voucher2b_list'.time().date('d_m_Y').'.doc');
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
                        'Vouchers2b.user_id = ViewDfoRo.ro_user_id'
                    )
                )                
            ),
            'conditions'=> $condition,   
            'order' => array('code' => 'desc')
        )+$limit;
        $vouchers = $this->paginate('Vouchers2b');
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
            $this->loadModel('Vouchers2b');
            $data = $this->Vouchers2b->find('first',array(
                'conditions'    => array(
                    'Vouchers2b.id'     => $id,
                ),
            ));
        }
        $this->set(array(
            'title'             => 'View Vouchers 2(B)',
            'data'              => $data,
            'usertype_id'       => $this->Session->read('usertype_id'),
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
        $this->loadModel('Vouchers2b');
        $details = array();
        /*
         *Save voucher 2b data
         */
        if(isset($this->data['Vouchers2b']) && is_array($this->data['Vouchers2b']) && count($this->data['Vouchers2b'])>0){
            if(isset($this->data['Vouchers2b']['voucher_date']) && $this->data['Vouchers2b']['voucher_date'] != ''){
                $this->request->data['Vouchers2b']['voucher_date'] = $this->date2DB($this->data['Vouchers2b']['voucher_date']);
            }
            if(isset($this->data['Vouchers2bdetail'][0]['collection_date']) && $this->data['Vouchers2bdetail'][0]['collection_date'] != ''){
                $this->request->data['Vouchers2bdetail'][0]['collection_date'] = $this->date2DB($this->data['Vouchers2bdetail'][0]['collection_date']);
            }            
            if($this->Vouchers2b->saveAll($this->data)){
                $this->request->data['Vouchers2b']['id'] = $this->Vouchers2b->id;
                $this->Flash->success('Voucher Details Saved Successfully !');
            }else{
                $this->Flash->error('Saving Failed !');
            }
        }
        /*
         *Code start for edit voucher2b
         */  
        if(isset($this->data['editVoucher2bForm']) && is_array($this->data['editVoucher2bForm']) && count($this->data['editVoucher2bForm'])>0){
            if(isset($this->data['editVoucher2bForm']['id']) && (int)$this->data['editVoucher2bForm']['id'] != 0){
                $this->Vouchers2b->id = $this->data['editVoucher2bForm']['id'];
                if($this->Vouchers2b->exists($this->data['editVoucher2bForm']['id'])){
                    $this->data = $this->Vouchers2b->findById($this->data['editVoucher2bForm']['id']);
                    unset($this->request->data['Vouchers2bdetail']);
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
            'title'             => 'Add Voucher 2(B)',
            'fyear'             => $fyear,
            'default_date'      => date("d-m-Y"),
            'accountList'       => $accountList,
            'fyear_id'          => $this->Session->read('fyear'),
            'user_id'           => $this->Session->read('user_id'),
            'usertype_id'       => $this->Session->read('usertype_id'),
            'details'           => $details,
        ));  
    }
    /**
     * [voucher2bDetails description]
     * @return [type] [description]
     */
    public function voucher2bDetails(){
        $this->layout = 'ajax';
        $details = array();
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $this->loadModel('Vouchers2bdetail');
            $details = $this->Vouchers2bdetail->find('all',array(
                'recursive'     => -1,
                'conditions'    => array(
                    'Vouchers2bdetail.vouchers2b_id'    => $this->data['id'],
                ),
            ));
        }
        $this->set(compact('details'));
    }
    /**
     * [voucher2bDetailsDelete description]
     * @return [type] [description]
     */
    public function voucher2bDetailsDelete(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $this->loadModel('Vouchers2bdetail');
            $this->Vouchers2bdetail->id = $this->data['id'];
            if($this->Vouchers2bdetail->exists()){
                if($this->Vouchers2bdetail->delete()){
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
     * [voucher2bDelete description]
     * @return [type] [description]
     */
    public function voucher2bDelete(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $this->loadModel('Vouchers2b');
            $this->Vouchers2b->id = $this->data['id'];
            if($this->Vouchers2b->exists()){
                if($this->Vouchers2b->delete()){
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
        $this->loadModel('Vouchers2bReport');
        if(isset($this->data['Vouchers2bReport']) && is_array($this->data['Vouchers2bReport']) && count($this->data['Vouchers2bReport'])>0){
            if(isset($this->request->data['Vouchers2bReport']['report_date']) && $this->request->data['Vouchers2bReport']['report_date'] != ''){
                $this->request->data['Vouchers2bReport']['report_date'] = $this->date2DB($this->request->data['Vouchers2bReport']['report_date']);
            }
            if($this->Vouchers2bReport->save($this->data)){
                $this->Flash->success('Voucher Details Saved Successfully !');
                $this->redirect(array('action' => 'index'));
            }else{
                $this->Flash->error('Saving Failed !');
            }
        }
        $this->set(array(
            'title'     => 'Add Voucher 2(B) Report',
            'id'        => $id,
        ));
    }
    public function download(){
        $this->autoRender = false;
        if(!empty($this->data['Download'])){
            $file_name   = $this->data['Download']['file_name'];
            $folder_key = $this->data['Download']['folder_name'];
            $contentArr = Configure::read('FILEEXTENSIONARR');
            $folderArr = array(
                'V'     => 'voucher',
                'F'     => 'fundAttachment',
            );            
            /*
             * Downlod Required Documents from the Desired Folder.
             */
            if(isset($file_name) && $file_name != '' && isset($folder_key) && $folder_key != ''){
                $ext = strtolower($this->getExt($file_name));
                $pathName   = 'files/'.$folderArr[$folder_key].'/'.$file_name;
            }
            if(file_get_contents($pathName)){
                $buffer   = file_get_contents($pathName);
                /*
                 * Download File
                 */
                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Content-Type: $contentArr[$ext]");
                header("Content-Transfer-Encoding: binary");
                header("Content-Length: " .strlen($buffer));
                header("Content-Disposition: attachment; filename =".$file_name);
                echo $buffer; 
            }else{
                echo "File not found for Download.";
            }
        }else{
            echo "File not found for Download.";
        }      
    }
    public function voucher2bApprove(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $fields = array();
            $curDate = date('Y-m-d H:i:s');
            $conds = array('Vouchers2b.id' => $this->data['id']);
            if($this->Session->read('usertype_id') == Configure::read('DFOUSERTTYPE')){
                $fields = array(
                    'Vouchers2b.is_approve_dfo'     => "'Y'",
                    'Vouchers2b.approve_dfo_by'     => $this->Session->read('id'),
                    'Vouchers2b.approve_dfo_date'   => "'$curDate'",
                );
            }else if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                $fields = array(
                    'Vouchers2b.is_approve_accountant'      => "'Y'",
                    'Vouchers2b.approve_accountant_by'      => $this->Session->read('id'),
                    'Vouchers2b.approve_accountant_date'    => "'$curDate'",
                );
            }
            $this->loadModel('Vouchers2b');
            $this->Vouchers2b->id = $this->data['id'];
            if($this->Vouchers2b->exists()){
                if(is_array($fields) && count($fields)>0){
                    if($this->Vouchers2b->updateAll($fields,$conds)){
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
    public function voucher2bReject(){
        $this->autoRender = false;
        if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $remarks = $this->data['remarks'];
            $fields = array();
            $conds = array('Vouchers2b.id' => $this->data['id']);
            $curDate = date('Y-m-d H:i:s');
            if($this->Session->read('usertype_id') == Configure::read('DFOUSERTTYPE')){
                $fields = array(
                    'Vouchers2b.is_reject_dfo'     => "'Y'",
                    'Vouchers2b.reject_dfo_by'     => $this->Session->read('id'),
                    'Vouchers2b.reject_dfo_date'   => "'$curDate'",
                    'Vouchers2b.dfo_remark'        => "'$remarks'",
                );
            }else if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
                $fields = array(
                    'Vouchers2b.is_reject_accountant'      => "'Y'",
                    'Vouchers2b.reject_accountant_by'      => $this->Session->read('id'),
                    'Vouchers2b.reject_accountant_date'    => "'$curDate'",
                    'Vouchers2b.accountant_remark'          => "'$remarks'",
                );
            }
            $this->loadModel('Vouchers2b');
            $this->Vouchers2b->id = $this->data['id'];
            if($this->Vouchers2b->exists()){
                if(is_array($fields) && count($fields)>0){
                    if($this->Vouchers2b->updateAll($fields,$conds)){
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