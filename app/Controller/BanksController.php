<?php 
App::uses('AppController', 'Controller');

class BanksController extends AppController {
    public $components = array('Flash', 'Session', 'Paginator');
    public $helpers = array('Form', 'Html', 'Js', 'Message');
    public $paginate = array('limit' => 25, 'order' => array('Bank.title' => 'asc'));

    /**
     * Index Action
     */
    public function index() {
        $this->set('title', 'Banks List');
        $this->set('banks', $this->Paginator->paginate());
    }


    /**
     * Add Action
     */

    public function add() {
        $this->set('title', 'Add Bank');
        $options_is_enable = array('1' => 'Yes', '0' => 'No');
        $this->set('options_is_enable', $options_is_enable);

        if ($this->request->is('post')) {
            $this->Bank->create();
            if ($this->Bank->save($this->request->data)) {
                $this->Flash->success('Bank Saved Successfully !');
                $this->redirect(array('controller' => 'banks', 'action' => 'index'));
            } else {
                $this->Flash->error('Saving Failed !');
            }
        }

    }

    /**
     * Edit Action
     */

    public function edit($id) {
        $this->set('title', 'Add Bank');
        $options_is_enable = array('1' => 'Yes', '0' => 'No');
        $this->set('options_is_enable', $options_is_enable);

        if ($this->request->is(array('post', 'put'))) {
            if ($this->Bank->save($this->request->data)) {
                $this->Flash->success('Bank Modified Successfully !');
                $this->redirect(array('controller' => 'banks', 'action' => 'index'));
            } else {
                $this->Flash->error('Saving Failed !');
            }
        }
        $this->request->data = $this->Bank->findById($id);
    }
    /**
     * Delete Action
     */
    public function delete($id) {
        $this->Bank->id = $id;
        $this->Bank->delete();
        $this->Flash->success('Bank Deleted Successfully !');
        $this->redirect(array('controller' => 'banks', 'action' => 'index'));
    }

}
?>