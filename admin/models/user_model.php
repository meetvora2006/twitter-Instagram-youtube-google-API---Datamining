<?php
class User_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    
	
	function get_user($id)
    {
	
	  $this->db->select('*');
	  $this->db->where('id', $id);
	  $this->db->from('tbl_user');
	  return $this->db->get()->row();
	   
	}
         
   
    function update_post($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('tbl_post', $data);
	}

   
	function delete_user($id){
	$this->db->delete('tbl_user', array('id' => $id));
	$this->db->delete('tbl_favourite', array('userid' => $id));
	$this->db->delete('tbl_stack', array('userid' => $id));
	$this->db->delete('tbl_stack_record', array('userid' => $id));
	}
 
}
