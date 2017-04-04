<?php 
class Userstacklist extends CI_Controller {

 public function __construct() {
		parent::__construct();
		$this->load->model('userstacklist_model');
		$this->load->helper('url');

		}
	 function show($id)
	
	{   
		$data['query'] = $this->userstacklist_model->allstacklist_getall($id);
		$this->load->view('userstacklist_view',$data);		
		}
		

public function title($title){
		  
if (strpos($title,'(') !== false) {		  
preg_match_all ("/\((.*?)\)/", $title, $pat_array);
$arr = explode(' ',$pat_array[1][0]);
 $ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.instagram.com/v1/tags/'.$arr[0].'?access_token=806401368.5aa13be.4a08df065cbb41469c9cc20041432d3b');

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

 $contents = curl_exec($ch);
 $media = json_decode($contents, true);
 
 return preg_replace("/\([^)]+\)/",$media['data']['media_count'],$title);
 
}
else
{
return $title;	
	}
		 
  } 

}