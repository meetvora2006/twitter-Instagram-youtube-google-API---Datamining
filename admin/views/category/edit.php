<html>
<head>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<title>edit user</title>
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	
</head>
<body>
<?php 



$this->load->helper('form');

$hidden = array('formsubmit' => '1');
echo form_open('category/edit/'.$this->uri->segment(3), '', $hidden);?>

<p>
    <label for="name">Category Name</label><input type="text" name="catname"  value="<?php echo $catname; ?>" required  />
</p>


<p><input type="submit" value="Submit" /></p>



<?php echo form_close(); ?>
</body>
</html>