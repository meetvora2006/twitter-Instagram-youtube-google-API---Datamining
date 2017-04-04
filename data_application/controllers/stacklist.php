<?php 
class Stacklist extends CI_Controller {

 public function __construct() {
		parent::__construct();
		$this->load->model('stacklist_model');
		$this->load->helper('url');

		}
	 function show($id)
	
	{   
$data = $this->stacklist_model->allstack_getall($id);
foreach($data as $row )
{ 
?>
<div class="insight_card" style="float:left">
<?php echo $row->name; ?>
<a href="#" onClick="getstacklistcard(<?php echo $row->id; ?>)" > Stacklist </a>
 
	<br/> 
    </div>
	<?php } 
    
    
		
		}
		

}