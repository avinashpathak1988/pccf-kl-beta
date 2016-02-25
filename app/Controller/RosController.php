<?php 
App::uses('AppController','Controller');

class RosController extends AppController{
	public $uses=array('Ro','Dfo','Usertype','Bank');
	public $components=array('Session','Paginator','Flash');
	public $helpers=array('Form','Html','Js','Message');
	
	public $paginate=array(
		'limit'=>25,
		'order'=>array(
			'Ro.title'=>'asc'
		)
	);
	
	public function index(){
		$this->set('title','RO List');
		$this->set('ros', $this->Paginator->paginate());
	}
	
	/**
	 * Add Action
	 */
	 
	public function add(){
		$this->set('title','Add RO');
		$options_is_enable=array(
			'1'=>'Yes',
			'0'=>'No'
		);	
		
		if($this->request->is('post')){
			$this->Ro->create();
			if($this->Ro->save($this->request->data)){
				$this->Flash->success('RO Created Successfully !');
				$this->redirect(array(
						'controller'=>'ros',
						'action'=>'index'
						)
					);
			}else{
				$this->Flash->error('Saving Failed !');
			}
		}
		
		
		$this->set('options_is_enable',$options_is_enable);
		$bank_id=$this->Bank->find('list',array(
				'conditions'=>array(
						'Bank.is_enable'=>1,
					),
				'order'=>array('Bank.title'=>'asc'),
			));
		$this->set(compact('bank_id'));
		
		$usertype_id=$this->Usertype->find('list',array(
				'conditions'=>array(
						'Usertype.is_enable'=>1,
					),
				'order'=>array('Usertype.title'=>'asc'),
			));
		$this->set(compact('usertype_id'));
		
		$dfo_id=$this->Dfo->find('list',array(
				'conditions'=>array(
						'Dfo.is_enable'=>1,
					),
				'order'=>array('Dfo.title'=>'asc'),
			));
		$this->set(compact('dfo_id'));
		
		
	}
	
	
	/**
	 * Edit Action
	 */
	
	public function edit($id){
		$this->set('title','Edit RO');
		$options_is_enable=array(
			'1'=>'Yes',
			'0'=>'No'
		);	
		
		$this->set('options_is_enable',$options_is_enable);
		$bank_id=$this->Bank->find('list',array(
				'conditions'=>array(
						'Bank.is_enable'=>1,
					),
				'order'=>array('Bank.title'=>'asc'),
			));
		$this->set(compact('bank_id'));
		
		$usertype_id=$this->Usertype->find('list',array(
				'conditions'=>array(
						'Usertype.is_enable'=>1,
					),
				'order'=>array('Usertype.title'=>'asc'),
			));
		$this->set(compact('usertype_id'));
		
		$dfo_id=$this->Dfo->find('list',array(
				'conditions'=>array(
						'Dfo.is_enable'=>1,
					),
				'order'=>array('Dfo.title'=>'asc'),
			));
		$this->set(compact('dfo_id'));
		
		if($this->request->is(array('put','post'))){
				if($this->Ro->save($this->request->data)){
					$this->Flash->success('RO Modified Successfully !');
					$this->redirect(array(
					'controller'=>'ros',
					'action'=>'index'
						));
				}else{
					$this->Flash->success('Modification Failed !');
				}
		}
		
		$this->request->data=$this->Ro->findById($id);
		
	}
	
	/**
	 * Delete Action
	 */
	
	public function delete($id){
		$this->Ro->id=$id;
		$this->Ro->delete();
		$this->Flash->success('RO Deleted Successfully !');
		$this->redirect(array(
				'controller'=>'ros',
				'action'=>'index'
			));
	}
	
}
 ?>