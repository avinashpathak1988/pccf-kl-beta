<?php 
App::uses('AppController', 'Controller');

class FinancialyearsController extends AppController {

    public $components = array('Flash', 'Session', 'Paginator');
    public $helpers = array('Form', 'Html', 'Js', 'Message');
    public $paginate = array('limit' => 25, 'order' => array('Financialyear.is_default' => 'desc', 'Financialyear.from_year' => 'desc'));

    public function index() {

        if ($this->request->is('post')) {

            $this->request->data['Financialyear']['title'] = $this->request->data['Financialyear']['from_year']." - ".$this->request->data['Financialyear']['to_year'];

            $count = $this->Financialyear->find('count', array('conditions' => array('Financialyear.title' => $this->request->data['Financialyear']['title'], )));



            //echo "<center><pre>".print_r($count).'<br>'.$count;
            //$log = $this->Financialyear->getDataSource()->getLog(false, false);
            //debug($log);

            if ($count <= 0) {

                if ($this->request->data['Financialyear']['is_default'] == 1) {
                    $this->Financialyear->query('update financialyears set is_default=0');
                }

                $this->Financialyear->create();
                if ($this->Financialyear->save($this->request->data)) {
                    $this->Flash->success('Financial Year Saved Successfully !');
                } else {
                    $this->Flash->error('Saving Failed !');
                }

            } else {
                $this->Flash->error('Financial Year already exists !');
            }


        }

        $this->set('title', 'Add Financial Year');
        $options_is_enable = array('1' => 'Yes', '0' => 'No');

        $options_is_default = $options_is_enable;

        $this->set('options_is_enable', $options_is_enable);
        $this->set('options_is_default', $options_is_default);
    }


    /**
     * Edit Action
     */

    public function edit($id) {
        $error = 0;

        if ($this->request->is(array('put', 'post'))) {
            $this->request->data['Financialyear']['title'] = $this->request->data['Financialyear']['from_year']." - ".$this->request->data['Financialyear']['to_year'];

            if ($this->request->data['Financialyear']['is_default'] == 1) {
                $this->Financialyear->query('update financialyears set is_default=0');
            }

            $this->Financialyear->save($this->request->data);
            $this->Flash->success('Financial Year Modified Successfully !');
            $this->redirect(array('controller' => 'financialyears', 'action' => 'listfy'));
        }


        $this->set('title', 'Edot Financial Year');
        $fyears = $this->Financialyear->findById($id);
        $this->set('fyears', $fyears);
        $this->request->data = $fyears;
        $options_is_enable = array('1' => 'Yes', '0' => 'No');

        $options_is_default = $options_is_enable;

        $this->set('options_is_enable', $options_is_enable);
        $this->set('options_is_default', $options_is_default);

    }

    /**
     * Listing Action
     */


    public function listfy() {
        $this->set('title', 'Manage Financial Years');
        $this->set('fyears', $this->Paginator->paginate());
        $this->render('list');
    }

    /**
     * Delete Action
     */

    public function delete($id) {
        $this->Financialyear->id = $id;
        $this->Financialyear->delete();
        $this->Flash->success('Deleted Successfully !');
        $this->redirect(array('controller' => 'financialyears', 'action' => 'listfy'));
        $this->render(null);
    }

}
?>