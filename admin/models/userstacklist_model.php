<?php 

class Userstacklist_model extends CI_Model {
	
	function Userstacklist_model()
	  {
	   parent::__construct();
	    $this->load->database(); 
	   }

     function allstacklist_getall($id)
	  {
	  
  $this->db->select("p.*");
  $this->db->where('sr.stackid', $id);
  $this->db->from('tbl_stack_record as sr');
  $this->db->join('tbl_post as p', 'p.id = sr.postid' , 'left');
  $query = $this->db->get();
  
  return $query->result();
	  
	   }
	   
}