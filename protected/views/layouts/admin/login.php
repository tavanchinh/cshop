<?php 
$baseUrl = Yii::app()->request->baseUrl;
?>
<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="<?php echo $baseUrl?>/images/logo-2.png" sizes="16x16"/>

    <title>Login Page</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css' />

    <!-- uikit -->
    <link rel="stylesheet" href="<?php echo $baseUrl?>/assets/admin/components/uikit/css/uikit.almost-flat.min.css"/>
    
    <!-- altair admin login page -->
    <link rel="stylesheet" href="<?php echo $baseUrl?>/assets/admin/css/login_page.min.css" />
    <!-- altair admin -->
    <link rel="stylesheet" href="<?php echo $baseUrl?>/assets/admin/css/main.min.css" media="all" />
    <script type="text/javascript" src="<?php echo $baseUrl;?>/assets/admin/js/jquery-1.11.1.min.js"></script>

</head>
<body class="login_page">
    <?php echo $content;?>
</body>
</html>