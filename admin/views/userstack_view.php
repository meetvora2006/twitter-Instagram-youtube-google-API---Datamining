<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css" media="screen" type="text/css" />

</head>

<body>

<div style="width:1300px" >

<?php

foreach($query as $row )
{ 
?>
<div class="insight_card" style="float:left">
<?php echo $row->name; ?>
  <a href="<?php echo base_url();?>admin.php/userstacklist/<?php echo $row->id; ?>" > stacklist </a>
	 
    </div>
	<?php } ?>

</div>

</body>
</html>
