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
echo form_open('user/edit/'.$this->uri->segment(3), '', $hidden);?>

<p>
    <label for="name">Username</label><input type="text" name="username"  value="<?php echo $username; ?>" required  />
</p>
<p>
    <label for="name">Email</label><input type="text" name="emailid"  value="<?php echo $email; ?>" required  />
</p>
<p>
    <label for="name">Image</label><input type="file" />
    <img src="<?php echo $imageurl; ?>" height="50px" width="50px" >
</p>

<p><input type="submit" value="Submit" /></p>



<?php echo form_close(); ?>
</body>
</html>