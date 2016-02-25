<?php 
App::uses('AppController', 'Controller');

class ReportController extends AppController {
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
    public function faVsExependiture(){
        $this->loadModel('Ro');
        $this->loadModel('Dfo');
        $this->loadModel('Financialyear');
        $this->loadModel('Account');        
        $conds 		= array();
        $roList 	= array();
        $dfoList 	= array();
        $condition 	= array();
        if($this->Session->read('usertype_id')  != Configure::read('ROUSERTTYPE')){
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
    	}	
        $fyear = $this->Financialyear->find('first', array(
            'conditions' => array(
            	'Financialyear.id' => $this->Session->read('fyear')
            ), 
            'fields' => array('Financialyear.title'), 
        ));
        $finanCial_year = $fyear['Financialyear']['title'];
        $hos = $this->Account->find('first', array(
        	'recursive'		=> -1,
            'conditions' => array(
            	'Account.id' => $this->Session->read('hos')
            ), 
            'fields'		=> array(
            	'Account.title'
            ),
        )); 
        $account_name = $hos['Account']['title'];
       	$this->set(array(
    		'title'				=> 'Financial Advance Vs Expenditure Report',
    		'usertype_id'   	=> $this->Session->read('usertype_id'),
    		'dfoList'			=> $dfoList,
    		'roList'			=> $roList,
    		'account_name'		=> $account_name,
    		'finanCial_year'	=> $finanCial_year,
    	));    	
    }
    public function faVsExependitureAjax(){
    	$this->layout = 'ajax';
    	$this->loadModel('FinancialAdvance');
    	$this->loadModel('Expenditure');
    	$ro_id 	= 0;
    	$dfo_id = 0;
    	$facond = array(
    		'FinancialAdvance.fyear'		=> $this->Session->read('fyear'),
    		'FinancialAdvance.account_id'	=> $this->Session->read('hos')
    	);
    	$expcond = array(
    		'Expenditure.fyear'				=> $this->Session->read('fyear'),
    		'Expenditure.account_id'		=> $this->Session->read('hos'),
    	);
        if($this->Session->read('usertype_id') == Configure::read('ROUSERTTYPE')){
            $facond += array(
            	'FinancialAdvance.usertype_id'    	=> Configure::read('ROUSERTTYPE'),
            	'FinancialAdvance.created_by'		=> $this->Session->read('id'),
            );
            $expcond += array(
            	'Expenditure.usertype_id'    	=> Configure::read('ROUSERTTYPE'),
            	'Expenditure.created_by'		=> $this->Session->read('id'),
            );
        }else if($this->Session->read('usertype_id') == Configure::read('DFOUSERTTYPE')){
            $facond += array(
            	'FinancialAdvance.usertype_id'    	=> Configure::read('DFOUSERTTYPE'),
            	'FinancialAdvance.created_by'		=> $this->Session->read('id'),
            );
            $expcond += array(
            	'Expenditure.usertype_id'    	=> Configure::read('DFOUSERTTYPE'),
            	'Expenditure.created_by'		=> $this->Session->read('id'),
            );                        
        }else if($this->Session->read('usertype_id') == Configure::read('ACCOUNTANTUSERTTYPE')){
            $facond += array(
            	'FinancialAdvance.usertype_id'    	=> Configure::read('DFOUSERTTYPE'),
            	'FinancialAdvance.created_by'		=> $this->Session->read('dfo_id'),
            ); 
            $expcond += array(
            	'Expenditure.usertype_id'    	=> Configure::read('DFOUSERTTYPE'),
            	'Expenditure.created_by'		=> $this->Session->read('dfo_id'),
            );               
        }else{
            $facond += array(
            	'FinancialAdvance.usertype_id'    	=> Configure::read('DFOUSERTTYPE'),
            );        	
        }  
        if(isset($this->params['named']['ro_id']) && (int)$this->params['named']['ro_id'] != 0){
            $ro_id   		= $this->params['named']['ro_id'];
            $facond         += array(
            	'FinancialAdvance.usertype_id'  => Configure::read('ROUSERTTYPE'),
            	'FinancialAdvance.user_id' 		=> $ro_id
            );
            $expcond += array(
            	'Expenditure.usertype_id'    	=> Configure::read('DFOUSERTTYPE'),
            	'Expenditure.user_id'			=> $ro_id,
            );             
        }
        if(isset($this->params['named']['dfo_id']) && (int)$this->params['named']['dfo_id'] != 0){
            $dfo_id   = $this->params['named']['dfo_id'];
            $facond          += array(
            	'FinancialAdvance.usertype_id'  => Configure::read('DFOUSERTTYPE'),
            	'FinancialAdvance.created_by' 	=> $dfo_id
            );
            $expcond += array(
            	'ViewDfoRo.dfo_id' 	=> $dfo_id
            );             
        }         	
    	$faData = $this->FinancialAdvance->find('all',array(
    		'recursive'		=> -1,
    		'fields'		=> array(
    			'FinancialAdvance.fa_date',
    			'SUM(FinancialAdvance.amount) as famount'
    		),
    		'conditions'	=> $facond,
    		'group'			=> array(
    			'FinancialAdvance.fa_date'
    		),
    	));
    	
    	$expData = $this->Expenditure->find('all',array(
    		'recursive'		=> -1,
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
    		'fields'		=> array(
    			'Expenditure.entry_date',
    			'SUM(Expenditure.amount) as expamount'
    		),
    		'conditions'	=> $expcond+array('Expenditure.is_approved_dfo'	=> 'Y'),
    		'group'			=> array(
    			'Expenditure.entry_date'
    		),
    	));
    	$expcond += array(
    		'Expenditure.is_approved_dfo'	=> 'N',
    		'Expenditure.is_rejected_dfo'	=> 'N',
    	);
    	$pendExpData = $this->Expenditure->find('all',array(
    		'recursive'		=> -1,
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
    		'fields'		=> array(
    			'SUM(Expenditure.amount) as expamount'
    		),
    		'conditions'	=> $expcond,
    	)); 

        if(isset($this->params['named']['reqType']) && $this->params['named']['reqType'] != ''){
            $this->layout='export_xls';
            if($this->params['named']['reqType']=='XLS'){
                $this->set('file_type','xls');
                $this->set('file_name','favsexpenditure_'.time().date('d_m_Y').'.xls');
            }else if($this->params['named']['reqType']=='DOC'){
                $this->set('file_type','doc');
                $this->set('file_name','favsexpenditure_'.time().date('d_m_Y').'.doc');
            }
            $this->set('is_excel','Y');  
        }    	    	    	
    	$this->set(array(
    		'faData'		=> $faData,
    		'expData'		=> $expData,
    		'ro_id'			=> $ro_id,
    		'dfo_id'		=> $dfo_id,
    		'pendExpData'	=> $pendExpData,
    	));
    }
}