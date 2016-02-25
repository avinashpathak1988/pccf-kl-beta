<?php 
App::uses('AppController', 'Controller');

class DfosController extends AppController {
    public $uses = array('Dfo', 'Usertype', 'Bank');
    public $components = array('Session', 'Paginator', 'Flash');
    public $helpers = array('Form', 'Html', 'Js', 'Message');

    public $paginate = array('limit' => 25, 'order' => array('Dfo.title' => 'asc'));

    public function index() {
        $this->set('title', 'DFO List');
        $this->set('dfos', $this->Paginator->paginate());
    }

    /**
     * Add Action
     */

    public function add() {
        $this->set('title', 'Add DFO');
        $options_is_enable = array('1' => 'Yes', '0' => 'No');

        if ($this->request->is('post')) {
            $this->Dfo->create();
            if ($this->Dfo->save($this->request->data)) {
                $this->Flash->success('DFO Created Successfully !');
                $this->redirect(array('controller' => 'dfos', 'action' => 'index'));
            } else {
                $this->Flash->error('Saving Failed !');
            }
        }


        $this->set('options_is_enable', $options_is_enable);
        $bank_id = $this->Bank->find('list', array('conditions' => array('Bank.is_enable' => 1, ), 'order' => array('Bank.title' => 'asc'), ));
        $this->set(compact('bank_id'));

        $usertype_id = $this->Usertype->find('list', array('conditions' => array('Usertype.is_enable' => 1, ), 'order' => array('Usertype.title' => 'asc'), ));
        $this->set(compact('usertype_id'));
    }


    /**
     * Edit Action
     */

    public function edit($id) {
        $this->set('title', 'Edit DFO');
        $options_is_enable = array('1' => 'Yes', '0' => 'No');

        $this->set('options_is_enable', $options_is_enable);
        $bank_id = $this->Bank->find('list', array('conditions' => array('Bank.is_enable' => 1, ), 'order' => array('Bank.title' => 'asc'), ));
        $this->set(compact('bank_id'));

        $usertype_id = $this->Usertype->find('list', array('conditions' => array('Usertype.is_enable' => 1, ), 'order' => array('Usertype.title' => 'asc'), ));
        $this->set(compact('usertype_id'));

        if ($this->request->is(array('put', 'post'))) {
            if ($this->Dfo->save($this->request->data)) {
                $this->Flash->success('DFO Modified Successfully !');
                $this->redirect(array('controller' => 'dfos', 'action' => 'index'));
            } else {
                $this->Flash->success('Modification Failed !');
            }
        }

        $this->request->data = $this->Dfo->findById($id);

    }

    /**
     * Delete Action
     */

    public function delete($id) {
        $this->Dfo->id = $id;
        $this->Dfo->delete();
        $this->Flash->success('DFO Deleted Successfully !');
        $this->redirect(array('controller' => 'dfos', 'action' => 'index'));
    }

}
?>