<?php 
//set_include_path(get_include_path() . PATH_SEPARATOR . "$_SERVER[DOCUMENT_ROOT]/ZendGdata-1.8.1/library/");
     

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('Datatables');
		$this->load->helper('datatables');
		//$this->load->library('Googlespreadsheet');
        $this->load->library('table');
        $this->load->database();
	    $this->load->model('user_model');
    }
    function index()
    {
       $tmpl = array ( 'table_open'  => '<table id="big_table" border="1" cellpadding="2" cellspacing="1" class="display">' );
       $this->table->set_template($tmpl); 
       $this->table->set_heading('Username', 'Email', 'Avatar', 'Actions');
	   $this->load->view('includes/header');
       $this->load->view('user/view');
    }
    function datatable()
    {
        $this->datatables->select('id,imageurl,username,email')
        ->unset_column('id')
		->unset_column('imageurl')
		->add_column('Avatar', '<img src="$1"/>', 'imageurl')
        ->add_column('Actions', get_buttons_user('$1'),'id')
        ->from('tbl_user');
        
        echo $this->datatables->generate();
    }

	 function edit()
    {
	$id = $this->uri->segment(3);	
	if($this->input->post("formsubmit") == '') {
    $data=$this->user_model->get_user($id);
    $this->load->view('user/edit' , $data);
	   }
	 else{
	  $data = array(
  		 	 "hero_text" => $this->input->post("hero_text"),
		 	 "sub_text" => $this->input->post("sub_text"),
		 	 "source" => $this->input->post("source"),
			);
	
	//$this->googlespreadsheet->updateRow($data,"id=".$id); 
		   
	$this->post_model->update_post($id,$data);	 
	 redirect(base_url('admin.php/user'));
	    }
    }
	
    function delete()
    {  
	//$row = array ( "status" => 2	);
	//$this->googlespreadsheet->updateRow($row,"id=".$_POST['postid']);
	$this->user_model->delete_user($_POST['postid']);
        
    }
}