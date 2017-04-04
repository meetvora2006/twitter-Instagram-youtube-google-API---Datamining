<?php 
set_include_path(get_include_path() . PATH_SEPARATOR . "$_SERVER[DOCUMENT_ROOT]/ZendGdata/library/");
     

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Post extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('Datatables');
		$this->load->helper('datatables');
		$this->load->library('Googlespreadsheet');
        $this->load->library('table');
        $this->load->database();
	    $this->load->model('post_model');
    }
    function index()
    {
        $tmpl = array ( 'table_open'  => '<table id="big_table" border="1" cellpadding="2" cellspacing="1" class="display">' );
        $this->table->set_template($tmpl); 
        
        $this->table->set_heading('Hero Text','Sub Text','Source','Actions');
		 $this->load->view('includes/header');
        $this->load->view('post/view');
    }
    function datatable()
    {
        $this->datatables->select('id,hero_text,sub_text,source')
		->where( array('status ' => 1) )
        ->unset_column('id')
        ->add_column('Actions', get_buttons('$1'),'id')
        ->from('tbl_post');
        
        echo $this->datatables->generate();
    }
	 function add()
    {
		
	if($this->input->post("formsubmit") == '') {
      $this->load->view('post/add');
	   }
	   else{
		
		 $subcat_add = $this->input->post("subcat_check");
		 
		  $data = array(
  		 	 "hero_text" => $this->input->post("hero_text"),
		 	 "sub_text" => $this->input->post("sub_text"),
		 	 "source" => $this->input->post("source"),
			 "status" => 1
			);
			
			
			$spreadsheetdata = array(
  		 	 "KeyStat" => $this->input->post("hero_text"),
		 	 "SubText" => $this->input->post("sub_text"),
		 	 "SourceName" => $this->input->post("source"),
			 "Show_Post" => "Y"
			);	
	

		$postid = $this->post_model->add_post($data);
		$this->googlespreadsheet->updateRow($spreadsheetdata,"id=".$postid); 
	
	foreach ($subcat_add as $subcat_add_ids){
	$data1 = array(
	'postid' => $postid,
	'subcatid' => $subcat_add_ids
	);

  	 $this->post_model->insert_subcat_post($data1);
	
 	$subcatdata= $this->post_model->get_subcatforsheeet_post($subcat_add_ids);
	 
	$sheetsubdata = array(
	 $subcatdata->catname => $subcatdata->subcatname
	
	);
 
	$this->googlespreadsheet->updateRow($sheetsubdata,"id=".$postid); 

	
	}
		 
	 redirect(base_url('admin.php/post'));
	   }
	  
    }
	
	 function edit()
    {
	$id = $this->uri->segment(3);	
	if($this->input->post("formsubmit") == '') {
    $data=$this->post_model->get_post($id);
    $this->load->view('post/edit' , $data);
	   }
	 else{
		 
	  $subcat_edit = $this->input->post("subcat_check");
	  $data = array(
  		 	 "hero_text" => $this->input->post("hero_text"),
		 	 "sub_text" => $this->input->post("sub_text"),
		 	 "source" => $this->input->post("source"),
			);
		
	$this->post_model->update_post($id,$data);
	
	$spreadsheetdata = array(
  		 	 "KeyStat" => $this->input->post("hero_text"),
		 	 "SubText" => $this->input->post("sub_text"),
		 	 "SourceName" => $this->input->post("source")
			);	
			
	$this->googlespreadsheet->updateRow($spreadsheetdata,"id=".$id); 
		   
		 
	$this->post_model->delete_subcat_post($id);
	
	foreach ($subcat_edit as $subcat_edit_ids){
	$data1 = array(
	'postid' => $id,
	'subcatid' => $subcat_edit_ids
	);

	$this->post_model->insert_subcat_post($data1);
	
	$subcatdata= $this->post_model->get_subcatforsheeet_post($subcat_edit_ids);
	$sheetsubdata = array(
	$subcatdata->catname => $subcatdata->subcatname
	);
 
	$this->googlespreadsheet->updateRow($sheetsubdata,"id=".$id); 
	
	}
	
	
	 redirect(base_url('admin.php/post'));
	    }
    }
	
    function delete()
    {  
	$row = array
	( "status" => 2	);
	//$this->googlespreadsheet->updateRow($row,"id=".$_POST['postid']);
	$this->post_model->delete_post($_POST['postid']);
        
    }


public function checkboxlist($pid=0)
{ 	
$categoryblock = $this->post_model->getcategoryinfo();
foreach($categoryblock as $catname )
{ ?>
<div style="display:inline-block;" >
<?php
echo $catname->catname;
$subcatlist = $this->post_model->getsubcat($catname->id);
?> 
<div>
<?php foreach($subcatlist as $row ){
$checksubcat = $this->post_model->checksubcat($row->id,$pid);
?>
	 
<input type="checkbox" name="subcat_check[]" value="<?php echo $row->id; ?>"  id="checkvalpass"  <?php if ($checksubcat==1) { ?>checked="checked" <?php  } ?>  /> <?php echo $row->subcatname; ?></br>

<?php } ?>
</div>
</div> 
	<?php }	
   }
}