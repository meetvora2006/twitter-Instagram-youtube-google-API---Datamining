<?php 

class Allcard_model extends CI_Model {
	
function Allcard_model()
  {
  parent::__construct();
  $this->load->database(); 
   }

function allcard_getall($limit, $offset)
  {
$query = $this->db->query("SELECT * FROM `tbl_post` WHERE `status`=1 LIMIT ".$limit." OFFSET ".$offset);
return $query->result();
   }
   
function allcard_getall_count()
  {
$this->db->where('status', 1);
$this->db->from('tbl_post');
return $this->db->count_all_results();
   }
	   
function checkfav($postid,$userid)
  {		 
  $this->db->where('postid', $postid);
  $this->db->where('userid', $userid);
  $this->db->from('tbl_favourite');
  return $this->db->count_all_results();
	}
	   
function checkstack($postid,$userid)
  {		 
  $this->db->where('postid', $postid);
  $this->db->where('userid', $userid);
  $this->db->from('tbl_stack_record');
  return $this->db->count_all_results();
   }

	   
function addtofav($postid,$userid)
 {
 $data = array(
 'postid' => $postid ,
 'userid' => $userid
	);
  $insert = $this->db->insert('tbl_favourite', $data);
	}
			
function delfromfav($postid,$userid)
 {
 $data = array(
 'postid' => $postid ,
 'userid' => $userid
		);
  $insert = $this->db->delete('tbl_favourite', $data);
	}
			
function getstacklist($userid)
  {
  $query = $this->db->query("SELECT * FROM `tbl_stack` WHERE `userid`=".$userid);
  return $query->result();	  
   }
	
function getstackchecked($postid,$stackid)
  {		
  $this->db->where('postid', $postid);
  $this->db->where('stackid', $stackid);
  $this->db->from('tbl_stack_record');
  return $this->db->count_all_results();
    }
	   
function addtostack($postid,$stackid,$userid)
  {
   $data = array(
   'stackid' => $stackid ,
   'postid' => $postid ,
   'userid' => $userid
		);
$insert = $this->db->insert('tbl_stack_record', $data);
	   }
	   
function removefromstack($postid,$stackid,$userid)
  {
	$data = array(
	 'stackid' => $stackid ,
	 'postid' => $postid ,
	 'userid' => $userid
		);
$insert = $this->db->delete('tbl_stack_record', $data);
	   }
	   
function checkuseremail($userid)
  {
  $this->db->select('*');
  $this->db->from('tbl_user');
  $this->db->where('id', $userid); 
return  $query = $this->db->get()->row_array();
	 }
	   
function addemail($email,$userid)
  {
  $data = array(
  'email' => $email
	);
$this->db->where('id', $userid);
$this->db->update('tbl_user', $data);
    }
	   
function addnewstack($stackname,$postid,$userid)
  {
	$data = array(
	 'name' => $stackname ,
	 'userid' => $userid
	);

$this->db->insert('tbl_stack', $data);
$newstackid = $this->db->insert_id();
	$data1 = array(
	 'stackid' => $newstackid ,
	 'postid' => $postid ,
	 'userid' => $userid
		);
$this->db->insert('tbl_stack_record', $data1);
return $newstackid;
	   }
	   
function getsubcat($catid)
	  {
  $query = $this->db->query("SELECT * FROM `tbl_subcategory` WHERE `catid`=".$catid);
  return $query->result();
	   }

function getsubcatname($id)
	  {
  $query = $this->db->query("SELECT subcatname FROM `tbl_subcategory` WHERE `id`=".$id);
  return $query->result();
	   }
	 
function getfilterpostid($subcatid, $limit, $offset)
	  { 
	  $subcatidList = implode(',', $subcatid);
	  $query = $this->db->query("SELECT p.* FROM `tbl_post_subcat` as ps , `tbl_post` as p WHERE find_in_set(ps.subcatid,'".$subcatidList."') and ps.postid=p.id GROUP BY ps.postid LIMIT ".$limit." OFFSET ".$offset);
	  return $query->result();
	   }  		 

function getfilterpostid_count($subcatid)
	  { 
	 $subcatidList = implode(',', $subcatid);
	 $query = $this->db->query("SELECT p.* FROM `tbl_post_subcat` as ps , `tbl_post` as p WHERE find_in_set(ps.subcatid,'".$subcatidList."') and ps.postid=p.id GROUP BY ps.postid");
 	 return $query->num_rows();
	  
	  
	   }  		

function getselectedcat($subcatid)
	  { 
	  $subcatidList = implode(',', $subcatid);
	  $query = $this->db->query("SELECT c.* FROM `tbl_category` as c , `tbl_subcategory` as sc WHERE find_in_set(sc.id,'".$subcatidList."') and c.id=sc.catid GROUP BY sc.catid ");
	  return $query->result();
	   }  

function getchildcat($catid,$subcatid)
	  { 
	  $subcatidList = implode(',', $subcatid);
	  $query = $this->db->query("SELECT * FROM `tbl_subcategory` WHERE find_in_set(id,'".$subcatidList."') and catid=".$catid );
	  return $query->result();
	   } 	
	   
	function getcatid($catname)
	  {
		
 	$query = $this->db->query("SELECT * FROM `tbl_category` WHERE `catname`='".$catname."'");
     return $query->row()->id;
	   }
   		 
			
}


?>