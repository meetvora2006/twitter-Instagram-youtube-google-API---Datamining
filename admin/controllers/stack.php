<?php     

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stack extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('Datatables');
        $this->load->library('table');
        $this->load->database();
    }
	
	 function show(){
       	$tmpl = array ( 'table_open'  => '<table id="big_table" border="1" cellpadding="2" cellspacing="1" class="display">' );
        $this->table->set_template($tmpl); 
        $this->table->set_heading('username','stackname');
		 $this->load->view('includes/header');
        $this->load->view('stack_view');
    }
	
    function datatable() { 
		$this->datatables->select('u.username,s.name')
		->where( array('sr.postid ' => $_POST['postid']) )
        ->from('tbl_stack_record as sr');
		$this->datatables->join('tbl_user as u', 'sr.userid = u.id' , 'inner');
		$this->datatables->join('tbl_stack as s', 'sr.stackid = s.id' , 'inner');
        echo $this->datatables->generate();
    }
	
}