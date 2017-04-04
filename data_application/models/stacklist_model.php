<?php 

class Stacklist_model extends CI_Model {
	
	function Stacklist_model()
	  {
	   parent::__construct();
	    $this->load->database(); 
	   }

     function allstack_getall($id)
	  {
  $this->db->select("id,name");
  $this->db->where('userid', $id);
  $this->db->from('tbl_stack');
  $query = $this->db->get();
  
  return $query->result();
	  
	   }
	   
}