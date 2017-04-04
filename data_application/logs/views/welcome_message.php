<?php
if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
    

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css" media="screen" type="text/css" />
<!--<link rel="stylesheet" href="<?php echo base_url();?>assets/css/CoverPop.css" type="text/css" media="all" />
--><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.2/normalize.css" media="screen" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/font.css" media="screen" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/unibox.min.css" media="screen" type="text/css" />

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.multiselect.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.multiselect.filter.css" />
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.multiselect.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.multiselect.filter.js"></script>
<script src="https://spoonacular.com/application/frontend/js/unibox.min.js?c=1"></script>
<script type="text/javascript">
$(function(){
	$("select").multiselect().multiselectfilter();
});
</script>
<script>
var base_url ='<?php echo base_url(); ?>';
var arr = ["1", "2", "3"];
</script>
</head>

<body id="test" ">

<?php
$ci =& get_instance();
 
if( !isset($_SESSION['id'])){ ?>
<div id="CoverPop-cover" class="splash">
    <div class="CoverPop-content splash-center">

        <h2 class="splash-title">before login</h2>

        <p class="splash-intro">Let's get vegetables out of our schools as soon as possible.</p>

        <p class="close-splash"><a class="CoverPop-close" href="#">or skip signup</a></p>

    </div><!--end .splash-center -->
</div><!--end .splash -->
<?php }else{
	

$profile = $ci->getemail($_SESSION['id']);

 if($profile['email'] == '') {?>

<div id="CoverPop-cover" class="splash">
    <div class="CoverPop-content splash-center">

        <h2 class="splash-title">Complete profile</h2>

       
        <form class="signup" action="index.php/allcard/addemail" method="post" accept-charset="utf-8">
            <input type="email" class="email-input input-text"  placeholder="email address*" name="email" required />
             <input type="hidden"  name="userid" value="<?php echo $_SESSION['id']; ?>" />
            <input type="submit" value="I Agree" class="submit-button">
        </form>

        <p class="close-splash"><a class="CoverPop-close" href="#">or do it letter</a></p>

    </div><!--end .splash-center -->
</div><!--end .splash -->





<?php
}

} ?>

<!----filter------->


<p >
<select title="platform/app" multiple="multiple" id="test_1"  ></select>
<!--<div id="test_1"></div>
--></p>

<p>
<select title="industry/theme" multiple="multiple" id="test_2"></select>
</p>

<p>
<select title="action/behaviour" multiple="multiple" id="test_3"></select>
</p>


<div id="unibox">
<input id="searchBox">
</div>

<div style="clear:both;"></div>
<!----all card------->
<input type="hidden" id="user_ses_id" value="<?php if( isset($_SESSION['id'])){echo $_SESSION['id'];}  ?>">

<div id="cardblock" style="display:block;" >


</div>

	
<script type="text/javascript" language="javascript" src='<?php echo base_url();?>assets/js/cards.js'></script>
<!--------------------all card end -------------->

<script src="http://immersed.in/CodeIgniter/assets/js/CoverPop.js"></script>

<?php


if( isset($_SESSION['id'])){
echo $_SESSION['twitter_screen_name'];
}

if( !isset($_SESSION['id'])){ ?>
<script>
    CoverPop.start({
		cookieName: 'beforelogin',
        expires: 0.01 // super short expiration (14.4 mins) for the demo
    });
</script>

<a href="http://immersed.in/CodeIgniter/index.php/twitter/auth" > login </a>

<?php }else{ if($profile['email'] == '') { ?>

<script>
    CoverPop.start({
		cookieName: 'afterlogin',
        expires: 0.01 // super short expiration (14.4 mins) for the demo
    });
</script>



<?php } ?>

<a href="http://immersed.in/CodeIgniter/index.php/twitter/reset_session" > logout </a>
<?php }

if( isset($_SESSION['id'])){
echo $_SESSION['id'];
} ?>

</body>
</html>