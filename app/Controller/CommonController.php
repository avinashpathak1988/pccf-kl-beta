<?php 
App::uses('AppController', 'Controller');

class CommonController extends AppController {
	public function getRo(){
		$this->layout = 'ajax';
		$this->loadModel('Ro');
		$roList = array();
		if(isset($this->data['dfo_id']) && (int)$this->data['dfo_id'] != 0){
			$roList = $this->Ro->find('list',array(
				'recursive'		=> -1,
				'conditions'	=> array(
					'Ro.dfo_id'	=> $this->data['dfo_id'],
				),
				'fields'		=> array(
					'Ro.user_id',
					'Ro.title',
				),
				'order'			=> array(
					'Ro.title'	=> 'ASC',
				),
			));
		}
		$this->set(array(
			'roList'	=> $roList,
		));
	}
}