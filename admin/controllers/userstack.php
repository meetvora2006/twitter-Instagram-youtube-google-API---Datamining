<?php 
class Userstack extends CI_Controller {

 public function __construct() {
		parent::__construct();
		$this->load->model('userstack_model');
		$this->load->helper('url');

		}
	 function show($id)
	
	{   
		$data['query'] = $this->userstack_model->allstack_getall($id);
		$this->load->view('userstack_view',$data);		
		}
		

}