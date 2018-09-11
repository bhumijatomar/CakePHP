<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Routing\Router;
use Cake\ORM\TableRegistry;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 *
 * @method \App\Model\Entity\Post[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PostsController extends AppController
{ 
  public function initialize()
  {
	  parent::initialize();
	  $this->loadmodel('Posts');
  }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $posts = $this->paginate($this->Posts);
		$userEmail = $this->request->Session()->read('Auth.User.email');
       $users = TableRegistry::get('Users');
                       $query = $users->query();
                       $query->select(['firstname'])
                             
                             ->where(['email' => $userEmail])
                             ->execute();
			  foreach($query as $q)
			  {
				  $name = $q['firstname'];
				  //echo $name;
				  
			  }
			  $session = $this->request->session();
			   $session->write('name',$name);
			  $name= $session->read('name');
			  //echo $name;

        $this->set(compact('posts'));
    }

	public function profile()
	{
	  $post='';
	  if($this->request->is('post'))
	  {
		  if(!empty($this->request->data['file']['name']))
		  {
			  $filename=$this->request->data['file']['name'];
			  $url = Router::url('/',true).'images/'.$filename;
			  $uploadpath = 'images/';
			  $uploadfile = $uploadpath.$filename;
			  if(move_uploaded_file($this->request->data['file']['tmp_name'], $uploadfile))
			  {
				$post = $this->Posts->newEntity();
                $post->name = $filename;
                 $post->path = $url;				
                    if($this->Posts->save($post))
					{
						
						$post = TableRegistry::get('Posts');
                       $query = $post->query();
                       $query->select(['path'])
                             
                             ->where(['name' => $filename])
                             ->execute();
						
                foreach($query as $pic)
			  {
				  $path = $pic['path'];
				  //echo $img;
				  
				  
			  }	
                  $session = $this->request->session();
			   $session->write('path',$path);
			  $img= $session->read('path');
			  //echo $img;
	

			  $this->Flash->success(__('File uploaded successfully'));
					}	
                    else{
						$this->Flash->error(__('Failed to upload file'));
					}						
			  }
			  else{
			       $this->Flash->error(__('Failed to upload'));
		         }
		  }
		  else{
		        $this->Flash->error(__('Please choose a file to upload'));
	        }
	  }
	  
	  
	  $userEmail = $this->request->Session()->read('Auth.User.email');
       $users = TableRegistry::get('Users');
                       $query = $users->query();
                       $query->select(['firstname'])
                             
                             ->where(['email' => $userEmail])
                             ->execute();
			  foreach($query as $q)
			  {
				  $name = $q['firstname'];
				  //echo $name;
				  
			  }
			  $session = $this->request->session();
			   $session->write('name',$name);
			  $name= $session->read('name');
			  //echo $name;
			  $this->set('post',$post);
		  
	}
    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('post', $post);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $users = $this->Posts->Users->find('list', ['limit' => 200]);
        $this->set(compact('post', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $users = $this->Posts->Users->find('list', ['limit' => 200]);
        $this->set(compact('post', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	

}
