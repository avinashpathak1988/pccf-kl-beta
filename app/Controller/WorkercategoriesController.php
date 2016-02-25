<?php  
App::uses('AppController','Controller');

class WorkercategoriesController extends AppController{
     
    public $components = array('Flash', 'Session', 'Paginator');
    public $helpers = array('Html', 'Message', 'Form', 'Money');
    
     public $paginate=array(
		'limit'=>25,
		'order'=>array(
			'Workercategory.title'=>'asc'
		)
	);

    /*Check Session Whether et or Redirect */

    public function afterFilter() {
        $this->response->disableCache();
        if ($this->Session->read('user_id') == '') {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


        if ($this->Session->read('fyear') == '') {
            $this->redirect(array('controller' => 'selections', 'action' => 'index'));
        }

    } 
    
   /*Index Action */
	
	public function index(){
		$this->set('title','Worker Categories');
		$this->set('categories', $this->Paginator->paginate());
       
	}
    
    
    /*Add Action */
    
    public function add(){
        $this->set('title','Add Worker Category');
         $is_enable=array(
            '0'=>'No',
            '1'=>'Yes'
        );
        $this->set('is_enable',$is_enable);
        if($this->request->is('post')){
            $this->Workercategory->create();
            if($this->Workercategory->save($this->request->data)){
                $this->Flash->success('Saved Successfully !');
                $this->redirect(array(
                    'controller'=>'workercategories',
                    'action'=>'index'
                ));
            }else{
                $this->Flash->error('Saving Failed !');
            }
        }
    }
    
    /*Edit Action*/
    public function edit($id){
        $this->set('title','Edit Worker Category');
         $is_enable=array(
            '0'=>'No',
            '1'=>'Yes'
        );
        $this->set('is_enable',$is_enable);
        if($this->request->is(array('post','put'))){
             if($this->Workercategory->save($this->request->data)){
                $this->Flash->success('Saved Successfully !');
                $this->redirect(array(
                    'controller'=>'workercategories',
                    'action'=>'index'
                ));
            }else{
                $this->Flash->error('Saving Failed !');
            }
        }
        $this->request->data=$this->Workercategory->findById($id);
    }
    
   /*Delete Action */ 
   public function delete($id){
       $this->Workercategory->id=$id;
       $this->Workercategory->delete();
       $this->Flash->success('Deleted Successfully !');
       $this->redirect(array(
           'controller'=>'workercategories',
           'action'=>'index'
       ));
   }
    
}

?>