<?php     

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Favourite extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('Datatables');
        $this->load->library('table');
        $this->load->database();
    }
	
	 function show(){
       	$tmpl = array ( 'table_open'  => '<table id="big_table" border="1" cellpadding="2" cellspacing="1" class="display">' );
        $this->table->set_template($tmpl); 
        $this->table->set_heading('username');
        $this->load->view('fav_view');
    }
	
    function datatable() { 
		$this->datatables->select('u.username')
		->where( array('f.postid ' => $_POST['postid']) )
        ->from('tbl_favourite as f');
		$this->datatables->join('tbl_user as u', 'f.userid = u.id' , 'inner');
        echo $this->datatables->generate();
    }
	
}