<?php namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model{
    protected $table              = 'sys_users';
    protected $returnType         = 'array';
    protected $allowedFields      = ['username', 'email','phone','status','profile_picture','password',
                                     'last_login','last_logout','last_accessed_ip','logins'
                                    ];
    protected $useTimestamps      = true;
    protected $createdField       = 'created_at';
    protected $updatedField       = 'updated_at';
    protected $beforeInsert       = ['beforeInsert'];
    protected $beforeUpdate       = ['beforeUpdate'];

    protected  function beforeInsert(array  $data){
        $data= $this->passwordHash($data);
        return $data;
    }

    protected  function beforeUpdate(array  $data){
        $data= $this->passwordHash($data);
        return $data;
    }
    protected  function passwordHash(array  $data){
        if (isset($data['data']['password'])){
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }

        return $data;
    }

}