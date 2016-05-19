<?php
/* @var $this MemberController */
/* @var $model Member */
/* @var $form CActiveForm */
$this->breadcrumbs=array(
	'Thay đổi mật khẩu',
);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'member-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
   <?php echo ($msg != '') ? '<span style="color:#44b6ae">'.$msg.'</span>' : '';?>
   <div class="row"> 
     <?php echo $form->labelEx($model,'old_password'); ?> 
     <?php echo $form->passwordField($model,'old_password'); ?> 
     <?php echo $form->error($model,'old_password'); ?> 
   </div>
 
   <div class="row"> 
     <?php echo $form->labelEx($model,'new_password'); ?> 
     <?php echo $form->passwordField($model,'new_password'); ?> 
     <?php echo $form->error($model,'new_password'); ?> 
   </div>
 
   <div class="row"> 
      <?php echo $form->labelEx($model,'repeat_password'); ?> 
      <?php echo $form->passwordField($model,'repeat_password'); ?> 
      <?php echo $form->error($model,'repeat_password'); ?> 
   </div>
 
  <div class="row submit">
    <?php echo CHtml::submitButton('Change password'); ?>
  </div>
  <?php $this->endWidget(); ?>
</div>