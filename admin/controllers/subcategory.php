<?php 
//set_include_path(get_include_path() . PATH_SEPARATOR . "$_SERVER[DOCUMENT_ROOT]/ZendGdata-1.8.1/library/");
     

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subcategory extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('Datatables');
		$this->load->helper('datatables');
		//$this->load->library('Googlespreadsheet');
        $this->load->library('table');
        $this->load->database();
	    $this->load->model('subcategory_model');
    }
    function index()
    {
        $tmpl = array ( 'table_open'  => '<table id="big_table" border="1" cellpadding="2" cellspacing="1" class="display">' );
        $this->table->set_template($tmpl); 
        $this->table->set_heading('Category','Subcategory');
		$this->load->view('includes/header');
        $this->load->view('subcategory/view');
    }
    function datatable()
    {
        $this->datatables->select('c.catname,s.subcatname')
        ->from('tbl_subcategory as s');
		$this->datatables->join('tbl_category as c', 's.catid = c.id' , 'inner');
        
        echo $this->datatables->generate();		
    }
	 function add()
    {
		
	if($this->input->post("formsubmit") == '') {
      $this->load->view('subcategory/add');
	   }
	   else{
		 
		  $data = array(
  		 	 "catname" => $this->input->post("catname"),
			);
			
	// $id = $_POST['postid']+1;
	//$this->googlespreadsheet->updateRow($data,"id=".$id); 

	$postid = $this->category_model->add_category($data);
	
	 		 
	 redirect(base_url('admin.php/subcategory'));
	   }
	  
    }
	
	function getcat(){
		return $this->subcategory_model->get_category_list();
		//print_r($catdetail);
		
		}
	
	 function edit()
    {
	$id = $this->uri->segment(3);	
	if($this->input->post("formsubmit") == '') {
    $data=$this->category_model->get_category($id);
    $this->load->view('subcategory/edit' , $data);
	   }
	 else{
		 
	 
	  $data = array(
  		 	 "catname" => $this->input->post("catname"),
			);
	
	//$this->googlespreadsheet->updateRow($data,"id=".$id); 
		   
	$this->category_model->update_category($id,$data);	 
	 
	
	
	 redirect(base_url('admin.php/subcategory'));
	    }
    }
	
    function delete()
    {  
	//$row = array
	//( "status" => 2	);
	//$this->googlespreadsheet->updateRow($row,"id=".$_POST['postid']);
	$this->category_model->delete_category($_POST['catid']);
        
    }

 
}