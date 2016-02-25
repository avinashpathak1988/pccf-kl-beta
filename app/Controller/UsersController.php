<?php 
App::uses('AppController','Controller');

class UsersController extends AppController{
		
	public $uses=array('Admin','Dfo','Ro','Accountant');
	public $components=array('Flash','Session','Paginator');
	public $helpers=array('Html','Message','Form');
	
	
	public function login(){
		$this->layout = 'user';
		
		if($this->request->is(array('post','put'))){
			$user_id=trim($this->request->data['User']['user_id']);
			$password=trim($this->request->data['User']['password']);
			
			$admin=$this->Admin->find('count',array(
				'conditions'=>array(
					'AND'=>array(
						'Admin.user_id'=>$user_id,
						'Admin.password'=>$password,
						'Admin.is_enable'=>1,
					)
				)
			));
				
			if($admin > 0){
				$data=$this->Admin->findByUserId($user_id);
				$this->Session->write('id',$data['Admin']['id']);
				$this->Session->write('user_id',$data['Admin']['user_id']);
				$this->Session->write('title',$data['Admin']['title']);
				$this->Session->write('usertype_id',$data['Admin']['usertype_id']);
			}
			
			$dfo=$this->Dfo->find('count',array(
				'conditions'=>array(
					'AND'=>array(
						'Dfo.user_id'=>$user_id,
						'Dfo.password'=>$password,
						'Dfo.is_enable'=>1,
					)
				)
			));
				
			if($dfo > 0){
				$data=$this->Dfo->findByUserId($user_id);
				$this->Session->write('id',$data['Dfo']['id']);
				$this->Session->write('user_id',$data['Dfo']['user_id']);
				$this->Session->write('title',$data['Dfo']['title']);
				$this->Session->write('usertype_id',$data['Dfo']['usertype_id']);
			}	
			
				$ro=$this->Ro->find('count',array(
					'conditions'=>array(
						'AND'=>array(
							'Ro.user_id'=>$user_id,
							'Ro.password'=>$password,
							'Ro.is_enable'=>1,
						)
					)
				));
				
			if($ro > 0){
				$data=$this->Ro->findByUserId($user_id);
				$this->Session->write('id',$data['Ro']['id']);
				$this->Session->write('user_id',$data['Ro']['user_id']);
				$this->Session->write('title',$data['Ro']['title']);
				$this->Session->write('usertype_id',$data['Ro']['usertype_id']);
				$this->Session->write('dfo_id',$data['Ro']['dfo_id']);
			}	
			
			
			$accountant=$this->Accountant->find('count',array(
					'conditions'=>array(
						'AND'=>array(
							'Accountant.user_id'=>$user_id,
							'Accountant.password'=>$password,
							'Accountant.is_enable'=>1,
						)
					)
				));
				
			if($accountant > 0){
				$data=$this->Accountant->findByUserId($user_id);
				$this->Session->write('id',$data['Accountant']['id']);
				$this->Session->write('user_id',$data['Accountant']['user_id']);
				$this->Session->write('title',$data['Accountant']['title']);
				$this->Session->write('usertype_id',$data['Accountant']['usertype_id']);
				$this->Session->write('dfo_id',$data['Accountant']['dfo_id']);
			}	
			
			if($accountant == 0 && $ro == 0 && $dfo == 0 && $admin == 0 ){
				$this->Flash->error('Invalid Login Credential !');
			}else{
				$this->redirect(array(
					'controller'=>'dashboard',
					'action'=>'index'
				));
			}
			
		}
		
	}
	
	public function logout(){
				$this->Session->write('user_id',NULL);
				$this->Session->write('title',NULL);
				$this->Session->write('usertype_id',NULL);
				$this->Session->write('fyear',NULL);
				$this->Session->write('hos',NULL);
				$this->redirect(array(
					'controller'=>'users',
					'action'=>'login'
				));
				
	}
	
}
 ?>