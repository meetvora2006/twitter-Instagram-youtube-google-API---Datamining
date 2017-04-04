<?php 

class Userfavourite_model extends CI_Model {
	
	function Userfavourite_model()
	  {
	   parent::__construct();
	    $this->load->database(); 
	   }

     function allfav_getall($id)
	  {
	  
  $this->db->select("p.*");
  $this->db->where('f.userid', $id);
  $this->db->from('tbl_favourite as f');
  $this->db->join('tbl_post as p', 'p.id = f.postid' , 'left');
  $query = $this->db->get();
  
  return $query->result();
	  
	   }
	   
}