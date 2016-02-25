<?php 
App::uses('AppController', 'Controller');

class DashboardController extends AppController {
    public function index() {
        $this->set('title', 'Dashboard');
    }

    public function afterFilter() {
        $this->response->disableCache();
        if ($this->Session->read('user_id') == '') {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


        if ($this->Session->read('fyear') == '') {
            $this->redirect(array('controller' => 'selections', 'action' => 'index'));
        }

    }
}
?>