<?php 

class Twitter_model extends CI_Model {
	
	function Twitter_model()
	  {
	   parent::__construct(); 
	   }

     function userinfo_insert($userdata)
	  {
		  
	   $this->load->database();
	   
	   $this->db->select('*');
	   $this->db->from('tbl_user');
	   $this->db->where('username', $userdata->screen_name);
	   $query = $this->db->get()->row_array();
	  if (empty($query)) {
		$date = date('Y-m-d'); 
		$time = date('h:i:s');
		$dateTime = $date." ".$time; 

   $data = array('username'=>$userdata->screen_name,
                'imageurl'=>$userdata->profile_image_url,
				'cr_date'=>$dateTime
		
				);


	    $this->db->insert('tbl_user', $data); 
		return $this->db->insert_id();
	  }
	  else
	  {
		
		return $query['id'];
		  
		  }
	   }

	   
}

?>