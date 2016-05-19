<?php 
$mobile_detect = new Mobile_Detect;
if($mobile_detect->isMobile()){
    $zoom = 'no';
}else{
    $zoom = 'yes';
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <meta http-equiv="content-language" content="vi" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=<?php echo $zoom?>"/>
    <meta name="title" content="<?php echo $this->pageTitle?>" />
    <meta name="revisit-after" content="1 days" />
    <meta name="ROBOTS" content="index,follow,noodp" />
    <meta name="googlebot" content="index,follow" />
    <meta name="BingBOT" content="index,follow" />
    <meta name="yahooBOT" content="index,follow" />
    <meta name="slurp" content="index,follow" />
    <meta name="msnbot" content="index,follow" />
    <meta property="og:site_name" content="hautruong.net" />
    <meta property="og:locale" content="vi_VN" />
	<title><?php echo $this->pageTitle?></title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,300,400,700" />
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Roboto%3A500%2C400italic%2C700%2C500italic%2C400%2C300&#038;ver=4.4.1' type='text/css' media=all />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/font-awesome.min.css" />
    <link rel="stylesheet" href="../css/owl.carousel.css" />
    <link rel="stylesheet" href="../css/style.css?v=1.0" />
    <?php if($mobile_detect->isMobile()){?>
    <link rel="stylesheet" type="text/css" href="/css/responsive.css?v=1.0" />
    <?php }?>
	<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="../js/owl.carousel.min.js"></script>
</head>
<body>
<div id="page">
<?php 

$folder = '';
if($mobile_detect->isMobile()){
    $folder  = 'mobile/';
}
include($folder.'includes/header.inc.php');

?>
<?php echo $content;?>
<?php include('includes/footer.inc.php');?>
<div class="hide" id="overlay_menu" onclick="$('.btn-humber').click()"></div>
<?php include('includes/ads.inc.php');?>
</div>
</body>
<?php include('includes/ads_balloon.inc.php');  ?>
</html>