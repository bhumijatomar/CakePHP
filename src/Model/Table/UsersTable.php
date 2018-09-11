<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\EntityInterface;

/**
 * Users Model
 *
 * @property \App\Model\Table\PostsTable|\Cake\ORM\Association\HasMany $Posts
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        
        $this->addBehavior('Timestamp');

        $this->hasMany('Posts', [
            'foreignKey' => 'user_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
		//$validator = new Validator;
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('firstname')
            ->maxLength('firstname', 255)
            ->requirePresence('firstname', 'create')
            ->notEmpty('firstname','Firstname should be filled!');

        $validator
            ->scalar('lastname')
            ->maxLength('lastname', 255)
            ->requirePresence('lastname', 'create')
            ->notEmpty('lastname','Please fill this field');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
             ->notEmpty('email','Email should be filled!');

        $validator
            ->scalar('password')
            ->requirePresence('password', 'create')
            ->notEmpty('password','Password should be filled!')
            ->add('password', [
            'minLength' => [
                'rule' => ['minLength', 5],
                'message' => 'Password should have minimum 5 characters.'
            ],
            'passLength' => [
                'rule' => function ($value) {
                        return (preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$_+=!%*^#?&])[A-Za-z\d$@$!_+=%*^#?&]{8,}$/', $value)=== 1);
                    },
                'message' => 'Password should have at least 1 alphabet, 1 number and 1 special character.'
            ]
        ]); 
		
		$validator
            ->scalar('confirmpassword')
            ->minLength('password', 5)
            ->requirePresence('confirmpassword', 'create')
            ->notEmpty('confirmpassword','Confirmpassword should be matched!');
			
        $validator
		    ->sameAs('confirmpassword','password','Password match failed!');
			
			
			
			
			
			
			
	   return $validator;
	   
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
	
	public function validationPassword(Validator $validator )
{


       

    $validator
        ->add('new_password', [
            'length' => [
                'rule' => ['minLength', 6],
                'message' => 'Min value is 6',
            ]
        ])
        ->add('new_password',[
            'match'=>[
                'rule'=> ['compareWith','confirm_password'],
                'message'=>'Password match failed',
            ]
        ])
        ->notEmpty('new_password');
    $validator
        ->add('confirm_password', [
            'length' => [
                'rule' => ['minLength', 6],
                'message' => 'Min value is 6',
            ]
        ])
        ->add('confirm_password',[
            'match'=>[
                'rule'=> ['compareWith','new_password'],
                'message'=>'Password match failed',
            ]
        ])
        ->notEmpty('confirm_password');

    return $validator;
}

}
