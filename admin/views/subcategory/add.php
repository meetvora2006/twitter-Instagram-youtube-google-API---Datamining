<html>
<head>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<title>Add Subscriber</title>
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	

</head>
<body>
<?php 
$ci =& get_instance();
$this->load->helper('form');
$hidden = array('formsubmit' => '1');
echo form_open('subcategory/add', '', $hidden);

print_r($ci->getcat());
?>
<p>
<select class=""  name="catname">
<option value="">Select Category</option>
	<?php
		foreach($ci->getcat()  as $k => $data1)
			{

			echo "<option value=".$data1['id'].">".stripslashes($data1['catname'])."</option>";

			}
	?>
</select>
</p>
<p>
    <label for="name">Subcategory Name</label><input type="text" name="subcatname" required  />
</p>

<p><input type="submit" value="Submit" /></p>

<?php echo form_close();  ?>
</body>
</html>