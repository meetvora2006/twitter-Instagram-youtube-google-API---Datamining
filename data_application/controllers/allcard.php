<?php 

if (!isset($_SESSION)) { session_start(); }
class allcard extends CI_Controller {

	function allcard()
	
	{
		parent::__construct();
		$this->load->model('allcard_model');
		$this->load->helper('url');
		$this->load->library('pagination');

		}
	 function index()
{

$this->load->view('welcome_message');		
		
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
  
   public function checkfav($postid,$userid){
	   return $this->allcard_model->checkfav($postid,$userid);
	  
   }
   
   public function checkstack($postid,$userid){
	   return $this->allcard_model->checkstack($postid,$userid);
	  
   }
   
   
   public function addtofav(){
	   
	  $this->allcard_model->addtofav($_POST['postid'],$_POST['userid']);
	
		} 
		
   public function delfromfav(){
	   
	  $this->allcard_model->delfromfav($_POST['postid'],$_POST['userid']);
	
		}
		
	public function getstacklist(){

 $userid = $_POST['userid'];		
 $postid = $_POST['postid'];
	   
 $stacklist = $this->allcard_model->getstacklist($userid);
	  
foreach ($stacklist as $row)
{ 
$stackcheck = $this->allcard_model->getstackchecked($postid,$row->id);
?>
<input type="checkbox" <?php if($stackcheck == 1) { ?> checked="checked"; onclick="removefromstack(<?php echo $postid;?>,<?php echo $row->id ?>,<?php echo $userid; ?>)"  <?php } else { ?>onclick="addtostack(<?php echo $postid;?>,<?php echo $row->id ?>,<?php echo $userid; ?>)" <?php } ?>  /><?php echo $row->name.'</br>'; 
  }
		} 
		
		
public function addtostack()
{
 $stackid = $_POST['stackid'];
 $postid = $_POST['postid'];
 $userid = $_POST['userid'];		

 $stackcheck = $this->allcard_model->addtostack($postid,$stackid,$userid);
 
 echo 'added';
	}
	
public function removefromstack()
{
 $stackid = $_POST['stackid'];
 $postid = $_POST['postid'];
 $userid = $_POST['userid'];		

 $stackcheck = $this->allcard_model->removefromstack($postid,$stackid,$userid);
 
 echo 'removed';
	}
	

public function getemail($userid)
	{  	
		
return $stackcheck = $this->allcard_model->checkuseremail($userid);
		
	}
	
	
public function addemail()
{
 $email = $_POST['email'];
 $userid = $_POST['userid'];

 $this->allcard_model->addemail($email,$userid);
 
  redirect('/allcard', 'refresh');
	}


public function addnewstack()
{
	

 $stackname = $_POST['stackname'];
 $postid = $_POST['postid'];
 $userid = $_POST['userid'];		

 $stackid = $this->allcard_model->addnewstack($stackname,$postid,$userid); ?>
 
<input type="checkbox"  checked="checked"  onclick="removefromstack(<?php echo $postid;?>,<?php echo $stackid; ?>,<?php echo $userid; ?>)"  /> <?php echo $stackname; ?>

<?php 	}
	
public function getfilterresult($offset=0)
{


$config['base_url'] = 'http://gujaratpickers.com/gujratpick/index.php/allcard/getfilterresult';
$config['full_tag_open'] = '<div id="pagination">';
$config['full_tag_close'] = '</div>';
$config['per_page'] = 12; 

if(isset($_POST['checkedValues']))
{ ?>

<div style="display:block;">
<?php 
foreach ($_POST['checkedValues'] as $value) {
$subcatname=$this->allcard_model->getsubcatname($value);
	 ?>
<button onclick="rmvfrmfltr(<?php echo $value ; ?>)"><?php echo $subcatname[0]->subcatname ; ?></button>
	<?php	}  ?>
<button onclick="clearall()">clearall</button>    
</div>
<div style="clear:both;"></div>
	
<?php 
$filterpostid = $this->allcard_model->getfilterpostid($_POST['checkedValues'],$config['per_page'], $offset); 
$config['total_rows'] = $this->allcard_model->getfilterpostid_count($_POST['checkedValues']);
}
else
{
$filterpostid = $this->allcard_model->allcard_getall($config['per_page'], $offset); 
$config['total_rows'] = $this->allcard_model->allcard_getall_count();
}

$this->pagination->initialize($config); 


foreach($filterpostid as $row )
{ 
if( isset($_SESSION['id'])){ $postfav=$this->checkfav($row->id,$_SESSION['id']);	} else{ $postfav=0; }
if( isset($_SESSION['id'])){ $poststack=$this->checkstack($row->id,$_SESSION['id']);	} else{ $poststack=0; }

?>
<div class="insight_card" style="float:left">
<div class="id_txt">#<?php echo $row->id; ?></div>
<p class="key_txt_m"><?php echo $this->title($row->hero_text); ?></p>

    <div class="card-body">    
	    <p class = "sub_txt">
		   <?php echo $row->sub_text; ?>
		</p>
	    <p class = "source_txt">
		  <?php echo $row->source; ?>
		</p>
    </div>
	 <div class="card-footer">
     <div class="card-action"><span class="icon-heart <?php if($postfav==1) { echo 'active' ;} ?>" id="<?php echo $row->id; ?>" ></span>
     </div>
     <div class="toggleLink card-action" id="<?php echo $row->id; ?>"><span class="icon-add-to-list <?php if($poststack>0) { echo 'active' ;} ?>" ></span></div>
        
     <div class="share_sheet">    
	 <div class = "share_this"></div>
	 <input type="text" class="stackadd"><input type="button" class="addstackbutton" id="<?php echo $row->id; ?>" value="ok">
     </div>
        
     </div>
    </div>
	<?php } 
    ?>
<div style="clear:both;"></div>

<div style="display:block;"><?php echo $this->pagination->create_links();?></div>

<div id="urlstring">
<?php
if(isset($_POST['checkedValues'])) {
$selectedcat = $this->allcard_model->getselectedcat($_POST['checkedValues']);
foreach($selectedcat as $caturlinfo )
{ 
echo $caturlinfo->catname.'=';
$getchildcat = $this->allcard_model->getchildcat($caturlinfo->id,$_POST['checkedValues']);
$subcat=''; 
foreach($getchildcat as $subcaturlinfo )
{
$subcat.=$subcaturlinfo->subcatname.',' ;
}
echo rtrim($subcat,',');
echo '&' ;
} }
?>
</div>
 <?php
 	}
	
	
	
public function checktest()
{ 
if(!empty($_POST['pageurl'])) {
$catpart = explode('&amp;', $_POST['pageurl']);
foreach($catpart as $catname )
{
$getcatname = explode('=', $catname);
$subcatgroup = explode(',', $getcatname[1]);
$catgroup[] = $this->allcard_model->getcatid($getcatname[0]); 
$catid = $this->allcard_model->getcatid($getcatname[0]); 
$subcatlist = $this->allcard_model->getsubcat($catid);
 ?> 
<div id="checkval_<?php echo $catid;?>">

<?php foreach($subcatlist as $row ){?>
<option value="<?php echo $row->id; ?>" class="chekoptionselect" <?php if (in_array($row->subcatname, $subcatgroup)) { ?> selected="selected" <?php } ?>> <?php echo $row->subcatname; ?></option>
	
<?php } ?>
</div> 
	<?php }	
}
else {
	$catgroup = array(0);
	}
	$targetArray = array(1,2,3);
	
	$newArray = array_diff($targetArray, $catgroup);

foreach ($newArray as $value) {
       $subcatlist = $this->allcard_model->getsubcat($value);
 ?> 
<div id="checkval_<?php echo $value;?>">

<?php foreach($subcatlist as $row ){?>
	 
<option value="<?php echo $row->id; ?>" class="chekoptionselect"> <?php echo $row->subcatname; ?></option>	 
	
<?php } ?>
</div> 
<?php 
	}

  }
	
 
 }
