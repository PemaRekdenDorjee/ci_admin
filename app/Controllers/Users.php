<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Libraries\Make_bread;
use http\Url;

class Users extends BaseController
{
    /*
     * Display Users Details Action
     */
	public function index()
	{
        if(!session()->get('isLoggedIn')){
            return  redirect()->to(base_url().'/auth');
        }
	    $data=[
	        'heading' =>'System Users',
        ];
        // first load the library breadcrumb
        $make_bread = new Make_bread;
        // add the first crumb, the segment being added to the previous crumb's URL
        $make_bread->add('System Users', 'users', TRUE);
        // now, let's store the output of the breadcrumb in a variable and show it  inside a view
        $breadcrumb = $make_bread->output();
        $data['breadcrumb'] =$breadcrumb;
        $model = new  UsersModel();
        $users = $model->findAll();
        $data['users'] = $users;

		return view('users/users',$data);
	}
    /*
    * Create New  Users Action
    */
    public function create()
    {
        if(!session()->get('isLoggedIn')){
            return  redirect()->to(base_url().'/auth');
        }

        // first load the library breadcrumb
        $make_bread = new Make_bread;
        // add the first crumb, the segment being added to the previous crumb's URL
        $make_bread->add('System Users', 'users', TRUE);
        $make_bread->add('Create Users', 'create', TRUE);
        // now, let's store the output of the breadcrumb in a variable and show it  inside a view
        $breadcrumb = $make_bread->output();
        $data=[
            'heading' =>'Create New Users',
        ];
        $data['breadcrumb'] =$breadcrumb;
        helper(['form']);

        if ($this->request->getMethod()=='post'){
            $rules = [
                'username'         => 'required',
                'email'            => 'required|valid_email|is_unique[sys_users.email]',
                'phone'            => 'required|numeric|is_unique[sys_users.phone]',
                'password'         => 'required',
                'comfirm_password' => 'matches[password]',
            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{
                if(is_uploaded_file($_FILES['profile_pic']['tmp_name'])){
                    $file = $this->request->getFile('profile_pic');
                    $fileSize = 8192; //
                    $ext = ['png','jpg'];
                    $imageSize = $file->getSize();
                    $fileExt = $file->getExtension();
                    if( $imageSize > $fileSize || !in_array($fileExt,$ext) ){
                        $session = session();
                        $session->setFlashdata('error', 'file size and extention not accepted ');
                        return view('users/create',$data);
                    }
                    if($file->isValid() && !$file->hasMoved()){
                        $year = date('Y');
                        $month = date('M');
                        $date = date('d');
                        $fileUploadPath = './uploads/images/'.$year.'/'.$month.'/'.$date.'/';
                        $fileName=$file->getRandomName();

                        $file->move($fileUploadPath,$fileName);
                        $databaseFilepath='/uploads/images/'.$year.'/'.$month.'/'.$date.'/';
                        $fileNamePath = $databaseFilepath.$fileName;
                    }
                    $model = new UsersModel();
                    $userData = [
                        'username'        => $this->request->getVar('username'),
                        'email'           => $this->request->getVar('email'),
                        'phone'           => $this->request->getVar('phone'),
                        'password'        => $this->request->getVar('password'),
                        'profile_picture' => $fileNamePath
                    ];

                    $model->save($userData);
                    $session = session();
                    $session->setFlashdata('success', 'Successfully created new user');
                    return redirect()->to(base_url().'/users');
                }else{
                    $model = new UsersModel();
                    $userData = [
                        'username' => $this->request->getVar('username'),
                        'email'    => $this->request->getVar('email'),
                        'phone'    => $this->request->getVar('phone'),
                        'password' => $this->request->getVar('password')
                    ];

                    $model->save($userData);
                    $session = session();
                    $session->setFlashdata('success', 'Successfully created new user');
                    return redirect()->to(base_url().'/users');
                }

            }

        }
        return view('users/create',$data);
    }

    /*
     *  user profile action
     */
    public function profile($id)
    {
        if(!session()->get('isLoggedIn')){
            return  redirect()->to(base_url().'/auth');
        }
        // first load the library breadcrumb
        $make_bread = new Make_bread;
        // add the first crumb, the segment being added to the previous crumb's URL
        $make_bread->add('System Users', 'users', TRUE);
        $make_bread->add('Profile');
        // now, let's store the output of the breadcrumb in a variable and show it  inside a view
        $breadcrumb = $make_bread->output();
        $data=[
            'heading' =>'User Profile',
        ];
        $data['breadcrumb'] =$breadcrumb;
        $currentUserId= session()->get('id');
        $queryId = ($currentUserId ==$id)?$currentUserId:$id;
        $db      = db_connect();
        $builder = $db->query("select * from sys_users where id= $queryId");
        $row = $builder->getRow();
        $data['usersData'] = $row;

        return view('users/profile',$data);
    }
    /*
     * change  user password
     */
    public function changepwd(){
        if(!session()->get('isLoggedIn')){
            return  redirect()->to(base_url().'/auth');
        }
        $session = session();
        if ($this->request->getMethod()=='post') {
            $id = $this->request->getVar('user_id');
            $oldPassword =$this->request->getVar('old_password');
            $newPassword =$this->request->getVar('new_password');
            $confirmPassword =$this->request->getVar('comfirm_password');
            if($oldPassword==''){
                $session->setFlashdata('error', 'Old password is required ');
                return  redirect()->to(base_url().'/users/profile/'.$id);
            }
            if($newPassword==''){
                $session->setFlashdata('error', 'New password is required ');
                return  redirect()->to(base_url().'/users/profile/'.$id);
            }
            if($confirmPassword==''){
                $session->setFlashdata('error', 'Confirm password is required ');
                return  redirect()->to(base_url().'/users/profile/'.$id);
            }
            if($oldPassword==$newPassword){
                $session->setFlashdata('error', 'New Password and current password can not be the same! ');
                return  redirect()->to(base_url().'/users/profile/'.$id);
            }
            //verify old password
            $checkOldPassword =[
                'id'       => $id,
                'password' => $oldPassword
            ];
            //check new password and confirm password match
            if($newPassword != $confirmPassword){
                $session->setFlashdata('error', 'New password and confirm password does not match');
                return  redirect()->to(base_url().'/users/profile/'.$id);
            }
            if(!$this->verifyPassword($checkOldPassword)){
                $session->setFlashdata('error', 'Old password is wrong');
                return  redirect()->to(base_url().'/users/profile/'.$id);
            }
            $model = new UsersModel();
            $changePwd = [
                'id'       => $id,
                'password' => $newPassword
            ];
           // dd($changePwd);
            $model->save($changePwd);
            $session->setFlashdata('success', 'Successfully chnage the password');
            return  redirect()->to(base_url().'/users/profile/'.$id);

        }

    }
    /*
     * Verify user old password
     */
    private function verifyPassword(array $data){
        $id=$data['id'];
        $db      = db_connect();
        $builder = $db->query("select * from sys_users where id= $id");
        $row = $builder->getRow();
        return password_verify($data['password'],$row->password);

    }
    /*
     * change user profile picture action
     */
    public function changephoto()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url() . '/auth');
        }
        $session = session();
        if ($this->request->getMethod()=='post') {
            $id = $this->request->getVar('user_id');
            if (is_uploaded_file($_FILES['new_profile_pic']['tmp_name'])) {
                 $file = $this->request->getFile('new_profile_pic');
                 $fileSize = 15000; //
                 $ext = ['png','jpg'];
                 $imageSize = $file->getSize();
                 $fileExt = $file->getExtension();
                 if( $imageSize > $fileSize || !in_array($fileExt,$ext) ){
                     $session->setFlashdata('error', 'file size and extention not accepted ');
                     return  redirect()->to(base_url().'/users/profile/'.$id);
                 }
                 if($file->isValid() && !$file->hasMoved()){
                     $year = date('Y');
                     $month = date('M');
                     $date = date('d');
                     $fileUploadPath = './uploads/images/'.$year.'/'.$month.'/'.$date.'/';
                     $fileName=$file->getRandomName();

                     $file->move($fileUploadPath,$fileName);
                     $databaseFilepath='/uploads/images/'.$year.'/'.$month.'/'.$date.'/';
                     $fileNamePath = $databaseFilepath.$fileName;
                     $model = new UsersModel();
                     $userData = [
                         'id'              => $id,
                         'profile_picture' => $fileNamePath
                     ];
                     $model->save($userData);
                     $session->setFlashdata('success', 'Successfully change the profile picture');
                     return  redirect()->to(base_url().'/users/profile/'.$id);
                 }else{
                     $session->setFlashdata('error', 'File has been move somewhere try again');
                     return  redirect()->to(base_url().'/users/profile/'.$id);
                 }
            }
            $session->setFlashdata('error', 'Please select the new profile picture');
            return  redirect()->to(base_url().'/users/profile/'.$id);
        }
    }
    /*
     * reset password
     */
    public function resetpwd(){
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url() . '/auth');
        }
        $session = session();
        if ($this->request->getMethod()=='post') {
            $id = $this->request->getVar('user_id');
            //should use password generator to generate new password
            $newGeneratedPassword = '1234';
            $model = new UsersModel();
            $userData = $model->where('id', $id)
                ->first();
            $data =[
                'id'       => $id,
                'password' => $newGeneratedPassword
            ];
            $model->save($data);
            if(isset($model)){
                //send new password in email
                $receiverEmailaddress = $userData['email'];
                $newPassword =$newGeneratedPassword;
                $session->setFlashdata('success', 'Successfully reseted password, email has been sent to '.$receiverEmailaddress);
                return  redirect()->to(base_url().'/users/profile/'.$id);
            }


        }

    }
    /*
   * Update  User information Action
   */
    public function edit($id = null)
    {
        if(!session()->get('isLoggedIn')){
            return  redirect()->to(base_url().'/auth');
        }
        // first load the library breadcrumb
        $make_bread = new Make_bread;
        // add the first crumb, the segment being added to the previous crumb's URL
        $make_bread->add('System Users', 'users', TRUE);
        $make_bread->add('Update Users', 'update', TRUE);
        // now, let's store the output of the breadcrumb in a variable and show it  inside a view
        $breadcrumb = $make_bread->output();
        $data=[
            'heading' =>'Update User Information',
        ];
        $data['breadcrumb'] =$breadcrumb;
        helper(['form']);
        $model = new UsersModel();
        $userData = $model->where('id',$id)->first();
        $data['userdata'] =$userData;


        return view('users/edit',$data);
    }
    /*
     * update profile
     */
    public function update(){
        if ($this->request->getMethod()=='post'){
            $rules = [
                'username'         => 'required',
                'phone'            => 'required|numeric',
            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{
                $id = $this->request->getVar('user_id');
                $model = new UsersModel();
                $userData = [
                    'id'       => $id,
                    'username' => $this->request->getVar('username'),
                    'phone'    => $this->request->getVar('phone'),
                ];

                $model->save($userData);
                $session = session();
                $session->setFlashdata('success', 'Successfully updated the user details');
                return redirect()->to(base_url().'/users/edit/'.$id);

            }
        }
    }

}
