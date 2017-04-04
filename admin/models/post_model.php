<?php
class Post_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }

    
    
    function add_post($data)
    {
	$this->db->insert('tbl_post', $data);
    return $insert_id = $this->db->insert_id();
  
	   
	}
	
	function get_post($id)
    {
	
	  $this->db->select('*');
	  $this->db->where('id', $id);
	  $this->db->from('tbl_post');
	  return $this->db->get()->row();
	   
	}
         

   
    function update_post($id, $data)
    {  
		$this->db->where('id', $id);
		$this->db->update('tbl_post', $data);
		
	}

   
	function delete_post($id){
		
		$data = array("status" => 2 ); 
		$this->db->where('id', $id);
		$this->db->update('tbl_post', $data);
	}
	
	function delete_subcat_post($id){
		
		$this->db->delete('tbl_post_subcat', array('postid' => $id)); 
	}
	
	
	function insert_subcat_post($data){
	$this->db->insert('tbl_post_subcat', $data); 
  
	}
	
	
	function getcategoryinfo(){
	 $query = $this->db->query("SELECT * FROM `tbl_category` ");
 	 return $query->result();
  
	}
	
	
	
	
	function getsubcat($catid)
	  {
  $query = $this->db->query("SELECT * FROM `tbl_subcategory` WHERE `catid`=".$catid);
  return $query->result();
	   }
	   
	   
	   function get_subcatforsheeet_post($subcatid)
	  {
		 
  $query = $this->db->query("SELECT c.catname,s.subcatname FROM tbl_category as c , tbl_subcategory as s WHERE s.id=".$subcatid." and c.id=s.catid ");
 
   return $query->row();
   	   }
	   
	   
	   
	 function checksubcat($subcatid,$pid)
	  {
  $query = $this->db->query("SELECT * FROM `tbl_post_subcat` WHERE `postid`=".$pid." and `subcatid`=".$subcatid );
  return $query->num_rows();
	   }
	
	
 
}
