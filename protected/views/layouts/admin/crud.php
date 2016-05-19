<!DOCTYPE HTML>
<head>
   <meta http-equiv="content-type" content="text/html" />
   <meta name="author" content="lovemoon" charset="UTF-8"/>
   <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/backend/css/bootstrap.min.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/backend/css/form.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/redactor/redactor.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/backend/css/crud.css" />
   <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/backend/js/jquery.min.js"></script>
   <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/backend/js/bootstrap.min.js"></script>
   <title><?php echo $this->pageTitle?></title>
</head>
<body>
   <?php 
   Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/backend/css/bootstrap.min.css');
   Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/backend/css/form.css');
   Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/backend/css/crud.css');
   ?>
   <?php include('header.inc.php');?>
   <?php include('menu.inc.php');?>
   <?php echo $content?>
</body>
