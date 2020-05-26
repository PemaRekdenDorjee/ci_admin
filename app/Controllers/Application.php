<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Make_bread;
use App\Models\UsersTable;

class Application extends BaseController
{
    protected  function init(){

        /*if(!session()->get('isLoggedIn')){
            return  redirect()->to(base_url().'/auth');
        }*/
        $this->_created = date('Y-m-d H:i:s');
        $this->_modified = date('Y-m-d H:i:s');
    }
    /*
     * User Dashboard
     */
	public function index()
	{
        if(!session()->get('isLoggedIn')){
            return  redirect()->to(base_url().'/auth');
        }
        $this->init();
        // first load the library breadcrumb
        $make_bread = new Make_bread;
        $breadcrumb = $make_bread->output();
        $data=[
            'heading' =>'Dashboard',
        ];
        $data['breadcrumb'] =$breadcrumb;

        $db =  db_connect();
        $userModel = new UsersTable($db);
        $result = $userModel->getCount();
        $data['count'] = $result;
		return view('app/dashboard', $data);
	}

}
