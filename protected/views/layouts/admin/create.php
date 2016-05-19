<!DOCTYPE HTML>
<head>
   <meta http-equiv="content-type" content="text/html" />
   <meta name="author" content="lovemoon" charset="UTF-8"/>
   <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/backend/css/bootstrap.min.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/backend/css/jquery-ui.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/backend/css/form.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/redactor/redactor.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/backend/css/main.css" />
   <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/backend/js/jquery.min.js"></script>
   <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/backend/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/backend/js/jquery-ui.js"></script>
   <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/redactor/redactor.js"></script>
   <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/redactor/fontsize.js"></script>
   <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/redactor/vi.js"></script>			
   <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/backend/js/actions.js"></script>
   <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/backend/js/js-function.js"></script>		
   <title><?php echo $this->pageTitle?></title>
</head>
<body>
   <?php if(isset($this->menu)  && !empty($this->menu) ){?>
   <div id="sidebar">
   	<div class="wapper">
      <i class="ic-arr"></i>
      <?php
   		$this->beginWidget('zii.widgets.CPortlet', array(
   			'title'=>'Thao tác',
   		));
   		$this->widget('zii.widgets.CMenu', array(
   			'items'=>$this->menu,
   			'htmlOptions'=>array('class'=>'operations'),
   		));
   		$this->endWidget();
   	?>
      </div>
   </div><!-- sidebar -->
   <?php }?>
   <div id="wapper" class="has-menu">
      <?php include ('header.inc.php')?>
      <?php include('menu.inc.php')?>
      <?php if(isset($this->breadcrumbs)):?>
   		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
   			'links'=>$this->breadcrumbs,
   		)); ?><!-- breadcrumbs -->
   	<?php endif?>
      <div class="main-content">
         <div class="row-fluid">
            <div class="block-fluid">
               <?php echo $content?>      
            </div>
         </div>
      </div>
   </div>
</body>