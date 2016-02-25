<?php 
App::uses('AppController','Controller');

class AdminsController extends AppController{

public $uses=array('Admin','Dfo','Usertype','Bank');
public $components=array('Flash','Session','Paginator');
public $helpers=array('Form','Html','Message','Js');
public $paginate=array(
		'limit'=>25,
		'order'=>array(
			'Admin.title'=>'asc'
		)
	);
	
/**
 * Index Action
 */
 public function index(){
 	$this->set('title','Admins List');
	$this->set('admins', $this->Paginator->paginate());
 }
 
 /**
  * Add Action
  */
  public function add(){
  	$this->set('title','Add Admin');
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
				'AND'=>array(
							
							'OR' => array(						
								'Usertype.title like '=>'%Admin%',							
								'Usertype.title  like '=>'%PCCF%',
							),
							'Usertype.is_enable'=>1,
						),
					),
				'order'=>array('Usertype.title'=>'asc'),
			));
		$this->set(compact('usertype_id'));

			if($this->request->is('post')){
				$this->Admin->create();
				if($this->Admin->save($this->request->data)){
					$this->Flash->success('Admin User Saved Successfully !');
					$this->redirect(array(
						'controller'=>'admins',
						'action'=>'index'
					));
				}else{
					$this->Flash->error('Saving Failed !');
				}
				
			}

  }
  /**
   * Edit Action
   */
   public function edit($id){
   		$this->set('title','Edit Admin');
		$options_is_enable=array(
			'1'=>'Yes',
			'0'=>'No'
		);	
		
				if($this->request->is(array('put','post'))){
				if($this->Admin->save($this->request->data)){
					$this->Flash->success('Admin User Modified Successfully !');
					$this->redirect(array(
						'controller'=>'admins',
						'action'=>'index'
					));
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
				'AND'=>array(
							
							'OR' => array(						
								'Usertype.title like '=>'%Admin%',							
								'Usertype.title  like '=>'%PCCF%',
							),
							'Usertype.is_enable'=>1,
						),
					),
				'order'=>array('Usertype.title'=>'asc'),
			));
		$this->set(compact('usertype_id'));
		
		$this->request->data=$this->Admin->findById($id);
   	
   }
   /**
    * Delete Action
    */
    public function delete($id){
    	$this->Admin->id=$id;
		$this->Admin->delete();
		$this->Flash->success('Admin Deleted Successfully !');
		$this->redirect(array(
				'controller'=>'admins',
				'action'=>'index'
			));
    }
	
}
 ?>