<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title><?php echo $this->pageTitle?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
      <link rel="icon" href="favicon.ico" type="image/x-icon" />
      <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" /> 
      <link rel="stylesheet" type="text/css" href='<?php echo Yii::app()->request->baseUrl;?>/css/error.css' />     
   </head>
   <body >
      <?php echo $content;?>   
   </body>
   
</html>