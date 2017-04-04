<?php
class Category_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    
	
	function get_category($id)
    {
	
	  $this->db->select('*');
	  $this->db->where('id', $id);
	  $this->db->from('tbl_category');
	  return $this->db->get()->row();
	   
	}
         
   
    function update_category($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('tbl_category', $data);
	}

   
	function delete_category($id){
	$this->db->delete('tbl_category', array('id' => $id));
	
	}
 
     function add_category($data)
    {
	$this->db->insert('tbl_category', $data);
     $this->db->insert_id();
  
	   
	}
 
}
