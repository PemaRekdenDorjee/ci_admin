<?php
namespace App\Validation;
use App\Models\UsersModel;

class UserRules
{
    public  function validateEmail(string $str, string $fields, array $data)
    {
        $model = new UsersModel();
        $user =$model->where('email', $data['email'])->first();
        if(!$user)
            return false;
        //return  password_verify($data['password'],$user['password']);
    }
    public  function validatePassword(string $str, string $fields, array $data)
    {
        $model = new UsersModel();
        $user =$model->where('email', $data['email'])->first();
        if(!$user)
            return false;
        return  password_verify($data['password'],$user['password']);
    }
    public  function validateStatus(string $str, string $fields, array $data)
    {
        $model = new UsersModel();
        $user =$model->where('email', $data['email'])->first();
        if(!$user &&  $user['status'] !=1)
            return false;
    }
}