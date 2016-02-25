<?php
App::uses('AppController', 'Controller');
/**
 * Schemes Controller
 *
 * @property Scheme $Scheme
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AllocationsController extends AppController {
	public function index() {
        $this->loadModel('Allocation');
		$condition = array();
		if($this->Session->read('usertype_id') == Configure::read('PCCFUSERTTYPE')){
			$condition += array(
				'Allocation.assign_by'		=> $this->Session->read('id'),
				'Allocation.usertype_id'	=> Configure::read('PCCFUSERTTYPE'),
			);
		}else if($this->Session->read('usertype_id') == Configure::read('DFOUSERTTYPE')){
			$condition += array(
				'Allocation.assign_by'		=> $this->Session->read('id'),
				'Allocation.usertype_id'	=> Configure::read('DFOUSERTTYPE'),
			);
		}
        $this->paginate = array(
			'limit'			=> 20,
            'order'     	=> array('Allocation.id'    => 'DESC'), 
            'conditions'	=> $condition,   
        );
        $this->set(array(
            'data'              	=> $this->paginate('Allocation'),
			'title'					=> 'Report for Fund Allocation',
        )); 
	}
	public function assignedAllocation(){
		$this->loadModel('Allocation');
        $this->paginate = array(
			'limit'			=> 20,
            'order'     	=> array('Allocation.id'    => 'DESC'), 
            'conditions'	=> array(
            	'Allocation.assign_to'			=> $this->Session->read('id'),
            	'Allocation.to_usertype_id'		=> $this->Session->read('usertype_id'),
            ),   
        );
        $this->set(array(
            'data'          => $this->paginate('Allocation'),
			'title'			=> 'Report for Assigned Fund Allocation',
        ));		
	}
	public function add() {
		$this->loadModel('UserType');
		$this->loadModel('Dfo');
		$this->loadModel('Scheme');
		$this->loadModel('Account');
		$this->loadModel('AllocationDetail');
		$this->loadModel('Financialyear');
		$subAccountList = array();
		/*
		 *Code start for saving data
		 */
		if(isset($this->data['Allocation']) && is_array($this->data['Allocation']) && count($this->data['Allocation'])>0){
			if(isset($this->data['AllocationDetail']) && is_array($this->data['AllocationDetail']) && count($this->data['AllocationDetail'])>0){
				if(isset($this->data['Allocation']['allocation_date']) && $this->data['Allocation']['allocation_date'] != ''){
					$this->request->data['Allocation']['allocation_date'] = $this->date2DB($this->data['Allocation']['allocation_date']);
				}
				/*
				 *Check the duplicate entry in fund details
				 */
				if(isset($this->data['Allocation']['id']) && (int)$this->data['Allocation']['id'] != 0 && isset($this->data['AllocationDetail'][0]['account_id']) && (int)$this->data['AllocationDetail'][0]['account_id'] != 0 && isset($this->data['AllocationDetail'][0]['sub_account_id']) && (int)$this->data['AllocationDetail'][0]['sub_account_id'] != 0){
					$details = $this->AllocationDetail->find('first',array(
						'recursive'		=> -1,
						'conditions'	=> array(
							'AllocationDetail.allocation_id'	=> $this->data['Allocation']['id'], 
							'AllocationDetail.account_id'		=> $this->data['AllocationDetail'][0]['account_id'],
							'AllocationDetail.sub_account_id'	=> $this->data['AllocationDetail'][0]['sub_account_id'],
						),
						'fields'		=> array(
							'AllocationDetail.id'
						),
					));
					if(isset($details['AllocationDetail']['id']) && (int)$details['AllocationDetail']['id'] != 0){
						$this->request->data['AllocationDetail'][0]['id'] = $details['AllocationDetail']['id'];
					}
				}
				if($this->Allocation->saveAll($this->data)){
	                $this->request->data['Allocation']['id'] = $this->Allocation->id;
	                $this->Flash->success('Fund allocate Successfully !');
				}else{
					$this->Session->setFlash(__('The Fund Allocation could not be saved. Please, try again.'));
				}
			}else{
				$this->Session->setFlash(__('Please fill acount details.'));
			}
		}
		/*
		 *Code start for edit data
		 */
		if(isset($this->data['editFundForm']) && is_array($this->data['editFundForm']) && count($this->data['editFundForm'])>0){
			if(isset($this->data['editFundForm']['id']) && (int)$this->data['editFundForm']['id'] != 0){
                $this->Allocation->id = $this->data['editFundForm']['id'];
                if($this->Allocation->exists($this->data['editFundForm']['id'])){
                    $this->data = $this->Allocation->findById($this->data['editFundForm']['id']);
                    unset($this->request->data['AllocationDetail']);
                }else{
                    $this->Session->setFlash('Invalid Store.', 'default', array('class' => 'success'));
                } 
			}
		}
		$accountList = $this->Account->find('list',array(
			'recursive'		=> -1,
			'fields'		=> array(
				'Account.id',
				'Account.title',
			),
			'conditions'	=> array(
				'Account.is_enable'=>1,
				'Account.parent_id IS NULL',
			)
		));
		if(isset($this->data['AllocationDetail'][0]['account_id']) && (int)$this->data['AllocationDetail'][0]['account_id'] != 0){
			$subAccountList = $this->Account->find('list',array(
				'recursive'		=> -1,
				'fields'		=> array(
					'Account.id',
					'Account.title',
				),
				'conditions'	=> array(
					'Account.is_enable' => 1,
					'Account.parent_id'	=> $this->data['AllocationDetail'][0]['account_id'],
				)
			));
		}
		$userList = array();
		$to_usertype_id = 0;
		if($this->Session->read('usertype_id') == Configure::read('PCCFUSERTTYPE')){
			$this->loadModel('Dfo');
			$userList   = $this->Dfo->find('list',array(
				'recursive'		=> -1,
				'conditions'	=> array(
					'Dfo.is_enable'	=> 1,
					'Dfo.usertype_id'	=> Configure::read('DFOUSERTTYPE'),
				),
				'fields'		=> array(
					'Dfo.id',
					'Dfo.title'
				)
			));
			$to_usertype_id = Configure::read('DFOUSERTTYPE');
		}else if($this->Session->read('usertype_id') == Configure::read('DFOUSERTTYPE')){
			$this->loadModel('Ro');
			$userList   = $this->Ro->find('list',array(
				'recursive'		=> -1,
				'conditions'	=> array(
					'Ro.is_enable'		=> 1,
					'Ro.usertype_id'	=> Configure::read('ROUSERTTYPE'),
					'Ro.dfo_id'     	=> $this->Session->read('id'),
				),
				'fields'		=> array(
					'Ro.id',
					'Ro.title'
				)
			));
			$to_usertype_id = Configure::read('ROUSERTTYPE');
		}
        /*
         *Get financial year
         */ 
        $fyear = $this->Financialyear->findById($this->Session->read('fyear'));
        $fyear = $fyear['Financialyear']['title'];		
        $this->set(array(
    		'title'				=> "Allocate Fund",
    		'userList'			=> $userList,
    		'userTypeId'		=> $this->Session->read('usertype_id'),
    		'accountList'		=> $accountList,
    		'subAccountList'	=> $subAccountList,
    		'userid'			=> $this->Session->read('id'),
    		'to_usertype_id'	=> $to_usertype_id,
    		'fyear_id'			=> $this->Session->read('fyear'),
    		'fyear'				=> $fyear,
        ));
	}
	public function view($id){
        $title = 'View Fund Allocation';
        $data = array();
        if($id){
            $this->loadModel('Allocation');
            $data = $this->Allocation->find('first',array(
                'conditions'    => array(
                    'Allocation.id'     => $id,
                ),
            ));
        }
        $this->set(compact('data','title'));		
	}
	public function subAccount(){
		$this->layout = 'ajax';
		$this->loadModel('Account');
		$subAccountList = array();
		if(isset($this->params['data']['id']) && (int)$this->params['data']['id'] != 0){
			$subAccountList = $this->Account->find('list',array(
				'recursive'		=> -1,
				'conditions'	=> array(
					'Account.is_enable'	=> 1,
					'Account.parent_id'	=> $this->params['data']['id'],
				)
			));
		}
		$this->set(array('subAccountList'=> $subAccountList));
	}
	public function fundAjaxList(){
		$this->layout = 'ajax';
		$id = 0;
		$ref = '';
		$fundDetailData = array();
		if(isset($this->data['id']) && (int)$this->data['id'] != 0){
			if(isset($this->data['ref']) && $this->data['ref'] != ''){
				$ref = $this->data['ref'];
			}
			$id = $this->data['id'];
			$this->loadmodel('AllocationDetail');
			$fundDetailData = 	$this->AllocationDetail->find('all',array(
				'recursive' 	=> -1,
				'joins'=>array(
					array(
						'table' => 'accounts',
						'alias' => 'Account',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array(
							'AllocationDetail.account_id = Account.id',
						)					
					),
					array(
						'table' => 'accounts',
						'alias' => 'SubAccount',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array(
							'AllocationDetail.sub_account_id = SubAccount.id',
						)					
					),										
				),
				'fields'		=> array('AllocationDetail.*','Account.title','SubAccount.title'),
				'conditions'	=> array(
					'AllocationDetail.allocation_id'	=> $id,
				),
				'order' => array('AllocationDetail.allocation_id' => 'DESC'),
			));
		}
		$this->set(array(
			'fundDetailData'=> $fundDetailData,
			'ref'			=> $ref,
		));
	}
	public function fundAjaxDelete(){
		$this->autoRender = false;
		$this->loadModel('AllocationDetail');
		if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $this->AllocationDetail->id = $this->data['id'];
            if($this->AllocationDetail->exists()){
                if($this->AllocationDetail->delete()){
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
	public function fundDelete(){
		$this->autoRender = false;
		$this->loadModel('Allocation');
		if(isset($this->data['id']) && (int)$this->data['id'] != 0){
            $this->Allocation->id = $this->data['id'];
            if($this->Allocation->exists()){
                if($this->Allocation->delete()){
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
	public function getFundAmount(){
		$this->layout 		= 'ajax';
		$this->autoRender   = false;
		$dfoAmount = 0;
		if($this->params['data']['fyear'] != '' && $this->params['data']['account_id'] != '' && $this->params['data']['sub_account_id'] != ''){
			$allocationDetails = $this->Allocation->find('all',array(
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
				'fields'		=> array(
						'SUM(AllocationDetail.amount) As amount',
				),
				'conditions'		=> array(
					'Allocation.assign_to'            	=> $this->Session->read('id'),
					'Allocation.to_usertype_id'		  	=> $this->Session->read('usertype_id'),
					'Allocation.fyear'            		=> $this->params['data']['fyear'],
					'AllocationDetail.account_id'     	=> $this->params['data']['account_id'],
					'AllocationDetail.sub_account_id' 	=> $this->params['data']['sub_account_id'],
				),
			));
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
				'fields'		=> array(
						'SUM(AllocationDetail.amount) As amount',
				),
				'conditions'		=> array(
					'Allocation.assign_by'            	=> $this->Session->read('id'),
					'Allocation.usertype_id'		  	=> $this->Session->read('usertype_id'),
					'Allocation.fyear'            		=> $this->params['data']['fyear'],
					'AllocationDetail.account_id'     	=> $this->params['data']['account_id'],
					'AllocationDetail.sub_account_id' 	=> $this->params['data']['sub_account_id'],
				),
			));
			$dfoAmount = $allocationDetails[0][0]['amount'] - $allocationExpDetails[0][0]['amount'];
		}
		echo $dfoAmount;
	}	
	public function fyearBalance(){
		$this->autoRender   = false;
		$dfoAmount = 0;
		if(isset($this->data['fyear']) && (int)$this->data['fyear'] != 0){
			$allocationDetails = $this->Allocation->find('all',array(
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
				'fields'		=> array(
						'SUM(AllocationDetail.amount) As amountbalance',
				),
				'conditions'		=> array(
					'Allocation.assign_to'            => $this->Session->read('id'),
					'Allocation.to_usertype_id'		  => $this->Session->read('usertype_id'),
					'Allocation.fyear'            	  => $this->data['fyear'],
				),
			));
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
				'fields'		=> array(
						'SUM(AllocationDetail.amount) As amountbalance',
				),
				'conditions'		=> array(
					'Allocation.assign_by'            => $this->Session->read('id'),
					'Allocation.usertype_id'		  => $this->Session->read('usertype_id'),
					'Allocation.fyear'            	  => $this->data['fyear'],
				),
			));
			$dfoAmount = $allocationDetails[0][0]['amountbalance'] - $allocationExpDetails[0][0]['amountbalance'];
		}
		echo $dfoAmount;		
	}
	public function report(){
       $this->set("title","Report for Fund Allocation");
        $this->loadModel('Allocation');
        $this->loadModel('UserType');
		$this->loadModel('Dfo');
		$this->loadModel('User');
		$this->loadModel('Scheme');
		//debug($condition);
        $this->paginate = array(
			'limit'			=> 20,
            'order'     	=> array(
            'Allocation.id'    => 'DESC',                     
            ),                        
        );
        $this->set(array(
            'data'              	=> $this->paginate('Allocation'),
			
        ));        
    }
    public function schemeDetails($scheme_id){
    	$this->layout = 'lightbox';
    	$allocationDetails 		= array();
    	$allocationExpDetails 	= array();
    	if($scheme_id){
			$allocationDetails = $this->Allocation->find('all',array(
				'conditions'		=> array(
					'Allocation.assign_to'            => $this->Session->read('id'),
					'Allocation.to_usertype_id'		  => $this->Session->read('usertype_id'),
					'Allocation.scheme_id'            => $this->data['scheme_id'],
				),
			));
			$allocationExpDetails = $this->Allocation->find('all',array(
				'conditions'		=> array(
					'Allocation.assign_by'            => $this->Session->read('id'),
					'Allocation.usertype_id'		  => $this->Session->read('usertype_id'),
					'Allocation.scheme_id'            => $this->data['scheme_id'],
				),
			));    		
    	}
    	$this->set(array(
    		'allocationDetails'		=> $allocationDetails,
    		'allocationExpDetails'	=> $allocationExpDetails,
    	));
    }
}