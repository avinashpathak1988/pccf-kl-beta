<?php 
App::uses('AppController', 'Controller');

class WorkersController extends AppController {
    public $components = array('Flash', 'Session', 'Paginator');
    public $helpers = array('Html', 'Message', 'Form', 'Money');

    public $paginate = array('limit' => 25, 'order' => array('Worker.title' => 'asc'));

    /**
     * Check session values before rendering
     */

    public function afterFilter() {
        $this->response->disableCache();
        if ($this->Session->read('user_id') == '') {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


        if ($this->Session->read('fyear') == '') {
            $this->redirect(array('controller' => 'selections', 'action' => 'index'));
        }

    }

    /**
     * add Action
     */

    public function add() {
        $this->set('title', 'Add Worker');
        $options_is_enable = array('1' => 'Yes', '0' => 'No');
        $ros = $this->Worker->Ro->find('list', array('conditions' => array('is_enable' => 1), ));
        $this->set('ros', $ros);
        $this->set('options_is_enable', $options_is_enable);
        
         $categories=$this->Worker->Workercategory->find('list',array(
            'conditions'=>array(
                'is_enable'=>1
            ),
            'order'=>array('title'=>'asc'),
        ));
        $this->set('categories',$categories);
        
        if ($this->request->is('post')) {
            $this->request->data['Worker']['user_id'] = $this->Session->read('user_id');
            $this->Worker->create();
            if ($this->Worker->save($this->request->data)) {
                $this->Flash->success('Saved Successfully ');
                $this->redirect(array('controller' => 'workers', 'action' => 'index'));
            } else {
                $this->Flash->error('Saving Failed !');
            }
        }

    }
    /**
     * Index Action
     */
    public function index() {
        $this->set('title', 'Workers List');
        $this->set('workers', $this->Paginator->paginate());
    }
    /**
     * Edit Action
     */
    public function edit($id) {
        $this->set('title', 'Add Worker');
        $options_is_enable = array('1' => 'Yes', '0' => 'No');
        $ros = $this->Worker->Ro->find('list', array('conditions' => array('is_enable' => 1), ));
        $this->set('ros', $ros);
        $this->set('options_is_enable', $options_is_enable);
        
        $categories=$this->Worker->Workercategory->find('list',array(
            'conditions'=>array(
                'is_enable'=>1
            ),
            'order'=>array('title'=>'asc'),
        ));
        $this->set('categories',$categories);
        
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['Worker']['user_id'] = $this->Session->read('user_id');
            if ($this->Worker->save($this->request->data)) {
                $this->Flash->success('Modified Successfully ');
                $this->redirect(array('controller' => 'workers', 'action' => 'index'));
            } else {
                $this->Flash->error('Modification Failed !');
            }
        }

        $this->request->data = $this->Worker->findById($id);
    }

    /**
     * Fetch Card Action
     */

    public function fetchcard($id) {
        $data = $this->Worker->findById($id);
        echo $data['Worker']['card_number'];
        exit();
    }

}
?>