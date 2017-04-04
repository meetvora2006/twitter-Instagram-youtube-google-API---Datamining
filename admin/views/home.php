<?php if(!isset($_SESSION)){
    session_start();
}?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

</head>


<body>
<div class="row" style="border:1px solid black; height:300px;">
sucess
<?php
echo $_SESSION['aname'];


if(isset($_SESSION['aname'])) { ?>
<a href="<?php echo base_url('login/logout') ?>">logout</a>
<?php } ?>
</div>
</body>
</html>
