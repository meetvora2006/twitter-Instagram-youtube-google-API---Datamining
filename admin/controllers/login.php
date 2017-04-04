<?php session_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{
	
	public function __Construct() {
		
		parent::__Construct();
				
	}
	
	function index($msg='') {
		$data['msg'] = $msg;
        $this->load->view('welcome_message.php', $data);
	}
	
	public function process(){
        $this->load->model('admin_model');
        $result = $this->admin_model->validate();
		
		$_SESSION['aname'] = $result->admin_name;
        if(! $result){
			$msg = '<font color=red>Invalid username and/or password.</font><br />';
            $this->index($msg);
        }else{
        	redirect(base_url('admin.php/post'));
        }        
    }
        
		public function logout(){
        session_destroy();
        redirect(base_url('/'));
           
    }
	
	
}

