<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
      <meta http-equiv="content-language" content="vi" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes"/>
      <meta name="title" content="<?php echo $this->pageTitle?>" />
      <meta name="revisit-after" content="1 days" />
	   <meta name="ROBOTS" content="index,follow,noodp" />
	   <meta name="googlebot" content="index,follow" />
	   <meta name="BingBOT" content="index,follow" />
	   <meta name="yahooBOT" content="index,follow" />
      <meta name="slurp" content="index,follow" />
      <meta name="msnbot" content="index,follow" />
      <title><?php echo $this->pageTitle?></title>
      <link rel="canonical" href="<?php echo Yii::app()->request->hostInfo.'/'.Yii::app()->request->getPathInfo();?>" />
      <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
      <link rel="stylesheet" type="text/css" href='<?php echo Yii::app()->request->baseUrl;?>/css/font-face.css' />
      <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/css/font-awesome.css"/>
      <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/css/bootstrap.css"/>
      <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/css/jquery-ui.min.css"/>
      <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/css/default.css?v=2.8"/>
       <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/css/styles.css?v=2.1"/>
       <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/css/responsive.css?v=1.11"/>

      <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery-1.8.3.js"></script>
      <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/bootstrap.js"></script>
      <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery-ui.min.js"></script>
      <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery.lazyload.min.js"></script>
      <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/actions.js"></script>
      <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/functions.js"></script>      
   </head>
   <body >
      <div id="page">
         <?php include('includes/header.inc.php');?>      
         <?php echo $content;?>   
         <?php include('includes/footer.inc.php');?>   
      </div>
   </body>
   
</html>
