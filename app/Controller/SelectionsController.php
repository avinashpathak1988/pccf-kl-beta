<?php 
App::uses('AppController', 'Controller');

class SelectionsController extends AppController {

    public $uses = array('Financialyear', 'Account');
    public $components = array('Flash', 'Session', 'Paginator');
    public $helpers = array('Html', 'Message', 'Form');


    public function index() {
        $this->set('title', 'Select Financial Year & Head Of Service');
        $fyear = $this->Financialyear->find('list', array('conditions' => array('is_enable' => 1), 'order' => array('is_default' => 'desc'), ));
        $this->set('fyear', $fyear);

        $hos = $this->Account->find('list', array('conditions' => array('is_enable' => 1, 'parent_id IS NULL'), 'order' => array('title' => 'asc'), ));
        $this->set('hos', $hos);

        if ($this->request->is(array('post', 'put'))) {


            $fyear1 = $this->request->data['Selections']['fyear'];
            $hos1 = $this->request->data['Selections']['hos'];

            $this->Session->write('fyear', $fyear1);
            $this->Session->write('hos', $hos1);

            $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));

        }


    }

}
?>