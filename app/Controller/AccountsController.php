<?php
App::uses('AppController', 'Controller');
/**
 * Accounts Controller
 *
 * @property Account $Account
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AccountsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title','Accounts List');
		$this->Account->recursive = 0;
		$this->set('accounts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Account->exists($id)) {
			throw new NotFoundException(__('Invalid account'));
		}
		$options = array('conditions' => array('Account.' . $this->Account->primaryKey => $id));
		$this->set('account', $this->Account->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title','Add Account');
		$this->set("options",array(array('1'=>'Yes','0'=>'No')));
		if ($this->request->is('post')) {
			$this->Account->create();
			if ($this->Account->save($this->request->data)) {
				$this->Flash->success('The account has been saved.');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error('The account could not be saved. Please, try again.');
			}
		}
		//$parentAccounts = $this->Account->ParentAccount->find('list');
		$parentAccounts = $this->Account->find('list',array(
			'conditions'=>array(
				'parent_id IS NULL'
			)
		));
		$this->set(compact('parentAccounts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
 
	public function edit($id = null) {
		$this->set('title','Edit Account');
		$this->set("options",array(array('1'=>'Yes','0'=>'No')));
		if (!$this->Account->exists($id)) {
			throw new NotFoundException(__('Invalid account'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Account->save($this->request->data)) {
				$this->Flash->success('The account has been saved.');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->success('The account could not be saved. Please, try again.');
			}
		} else {
			$options = array('conditions' => array('Account.' . $this->Account->primaryKey => $id));
			$this->request->data = $this->Account->find('first', $options);
		}
		//$parentAccounts = $this->Account->ParentAccount->find('list');
		$parentAccounts = $this->Account->find('list');
		$this->set(compact('parentAccounts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Account->id = $id;
		if (!$this->Account->exists()) {
			throw new NotFoundException(__('Invalid account'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Account->delete()) {
			$this->Flash->success('The account has been deleted.');
		} else {
			$this->Flash->success('The account could not be deleted. Please, try again.');
		}
		return $this->redirect(array('action' => 'index'));
	}
    
}
