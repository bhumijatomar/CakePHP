<?php
namespace App\Controller;
use Cake\Auth\DefaultPasswordHasher;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Validation\Validator;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Table;
use Cake\ORM\Entity;

use Cake\View\Helper\SessionHelper;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Mailer\Email;
use Cake\Core\Configure;
use Cake\Routing\Router;
use Cake\ORM\TableRegistry;
use App\Controller\AuthComponent;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
	
	public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['logout']);
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
		
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Posts']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
			   
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }
	
	 

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	//Email verification
	 public function thankyou()
	{
        
	global $passkey;
	$passkey=$_GET['passkey'];
	
	
	if($passkey=="")
	{
		
		   return $this->redirect(['action' => 'register']);
	}
else
{

	
	
$users = TableRegistry::get('Users');
$query = $users->query();
$query->update()
    ->set(['status' => "1"])
    ->where(['code' => $passkey])
    ->execute();

  }
   }
   
    
  //Change Password 
    public function changepass()
    {
        if($this->request->is('post'))			
		{ 
             $user = $this->Auth->identify();
            if($user)
			{
                $this->Auth->setUser($user);
		       $userEmail = $this->request->Session()->read('Auth.User.email');
	
		        $userPass = $_POST['password'];      
				$newPass = $_POST['new_password'];
		           if($userPass != $newPass)
			         {
				       $encpass = (new DefaultPasswordHasher)->hash($newPass);
				       $users = TableRegistry::get('Users');
                       $query = $users->query();
                       $query->update()
                             ->set(['password' => $encpass])
                             ->where(['email' => $userEmail])
                             ->execute();
			   
						
					    $this->Flash->success('Password has been changed.Please login.');
			            $this->redirect(['action' => 'login']);
	    	        }
			}
		else
		{
        
            $this->Flash->error(' Incorrect inputs.Please try again!');
			
        }
      }	
	}
 
		
    
	
	
	// Login
    public function login()
{
        if($this->request->is('post')){
            $user = $this->Auth->identify();
			
            if($user){
                $this->Auth->setUser($user);
				return $this->redirect(['controller' => 'posts']);
				
            }
            // Bad Login
            $this->Flash->error('Incorrect Login');
			
        }
    }
	
    // Logout
    public function logout(){
         $this->Flash->success('You are logged out');
		 return $this->redirect($this->Auth->logout());
    }


	 public function check(){
       
    }
		
	//Register
    public function register()
	{
		$confirm_code =md5((uniqid(rand(), true)));
        $user = $this->Users->newEntity();
		
	
        if($this->request->is('post'))
		{
            $user = $this->Users->patchEntity($user, $this->request->data);
			//$user->code = $confirm_code; 
			//print_r($user);
			if($this->Users->save($user))
			{
				//echo" hello";
				$email = new Email();
                $email->from('shivamkapoor515@gmail.com')
                ->to($user->email)
                ->subject('verification')
                ->send('Thankyou for registration!!!Please click on the given link to activate your account.http://localhost/login_cake/users/thankyou?passkey='.$confirm_code);
				
                $this->Flash->success('You are registered');
                return $this->redirect(['action' => 'check']);
            } else 
			{
                $this->Flash->error('You are not registered');
            }
        }
        $this->set(compact('user'));
        $this->set('_serialzie', ['user']);
		
	}
	
	
	 public function example()
	{
     // $this->autoRender= false;  
    }

    public function beforeFilter(Event $event)
	{
        $this->Auth->allow(['register']);

    }
	
	
}
