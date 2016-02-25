<?php 
App::uses('AppController', 'Controller');
/**
 * Usertypes Controller
 *
 * @property Usertype $Usertype
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsertypesController extends AppController {

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
        $this->set('title', 'User Types');
        $this->Usertype->recursive = 0;
        $this->set('usertypes', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Usertype->exists($id)) {
            throw new NotFoundException(__('Invalid usertype'));
        }
        $options = array('conditions' => array('Usertype.'.$this->Usertype->primaryKey => $id));
        $this->set('usertype', $this->Usertype->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->set("options", array(array('1' => 'Yes', '0' => 'No')));
        $this->set('title', 'Add User Type');
        if ($this->request->is('post')) {
            $this->Usertype->create();
            if ($this->Usertype->save($this->request->data)) {
                $this->Session->setFlash(__('The usertype has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The usertype could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->set("options", array(array('1' => 'Yes', '0' => 'No')));
        $this->set('title', 'Edit User Type');
        if (!$this->Usertype->exists($id)) {
            throw new NotFoundException(__('Invalid usertype'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Usertype->save($this->request->data)) {
                $this->Session->setFlash(__('The usertype has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The usertype could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Usertype.'.$this->Usertype->primaryKey => $id));
            $this->request->data = $this->Usertype->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Usertype->id = $id;
        if (!$this->Usertype->exists()) {
            throw new NotFoundException(__('Invalid usertype'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Usertype->delete()) {
            $this->Session->setFlash(__('The usertype has been deleted.'));
        } else {
            $this->Session->setFlash(__('The usertype could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}