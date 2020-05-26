<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Libraries\Make_bread;

class Auth extends BaseController
{
    protected  function init(){
        $this->_created = date('Y-m-d H:i:s');
        $this->_modified = date('Y-m-d H:i:s');
    }
    /*
     * login Action
     */
	public function login()
	{
        $this->init();
        if(session()->get('isLoggedIn')){
            return  redirect()->to(base_url());
        }
        $data=[];
        helper(['form']);
        if ($this->request->getMethod()=='post'){
            $rules = [
                'email'            => 'required|valid_email|validateEmail[email]',
                'password'         => 'required|validatePassword[password]',
            ];
            $customErrors =[
                'email' => [
                    'validateEmail' =>'User email  not\'t found in system'
                ],
                'password' => [
                    'validatePassword' =>'Password   does\'t match try again!'
                ],
            ];
            if(!$this->validate($rules, $customErrors)){
                $data['validation'] = $this->validator;
            }else{
                $userEmail= $this->request->getVar('email');

                $model = new UsersModel();
                $userDetails = $model->where('email',$userEmail)->first();
                $session = session();
                if($userDetails['status'] !=1):
                    $session->setFlashdata('warning', 'User have been block from system, please contact system admin');
                    return redirect()->to(base_url().'/auth/login');
                endif;
                //save user login details
                $userLog = [
                    'id'               => $userDetails['id'],
                    'last_accessed_ip' => $this->request->getIPAddress(),
                    'last_login'       => $this->_created,
                    'logins'           => $userDetails['logins']+1
                ];
                $model->save($userLog);
                //save user session
                $this->setUserSession($userDetails);
                $session->setFlashdata('success', 'Successfully Login');
                return redirect()->to(base_url());
            }

        }

		return view('auth/login',$data);
	}
    /*
    * Set user session
    */
    private function setUserSession($userDetails)
    {
        $data= [
            'id'         => $userDetails['id'],
            'username'   => $userDetails['username'],
            'email'      => $userDetails['email'],
            'profile_picture'      => $userDetails['profile_picture'],
            'isLoggedIn' => true
        ];
        session()->set($data);
        return true;
    }
    /*
     * login Action
     */
    public function logout()
    {
        $this->init();
        $data=[];
        helper(['form']);
        $id = session()->get('id');
        if($id !='' || $id !=null){
            //save user logout details
            $userLog = [
                'id'               => $id,
                'last_logout'      => $this->_created,
            ];
            $model = new UsersModel();
            $result= $model->save($userLog);
            if($result > 0){
                session()->destroy();
                $session = session();
                $session->setFlashdata('success', 'Successfully Logout');
                return view('/auth/login',$data);
            }
        }else{
            return  redirect()->to(base_url().'/auth');
        }



    }

}
