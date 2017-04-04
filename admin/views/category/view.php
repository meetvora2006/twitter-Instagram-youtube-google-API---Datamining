<html>
<head>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<title>Category management</title>
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.css">
<!--<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
-->		
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script type="text/javascript" language="javascript" charset="utf-8" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script>var base_url ='<?php echo base_url(); ?>';</script>
<script type="text/javascript" language="javascript" charset="utf-8" src="<?php echo base_url();?>assets/js/category.js"></script>


</head>
<body>
<div class="container">
<a href="http://gujaratpickers.com/gujratpick/admin.php/category/add">add</a>
			<h1>
				DataTables
			</h1>
			
<?php echo $this->table->generate(); ?>
            
   </div>
</body>
</html>