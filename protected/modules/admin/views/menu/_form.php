<?php
/* @var $this MenuController */
/* @var $model Menu */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'menu-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
    	<?php echo $form->labelEx($model,'parent_id'); ?>
    	<?php echo $form->textField($model,'parent_id'); ?>
    	<?php echo $form->error($model,'parent_id'); ?>
    </div>
        

    <div class="row">
    	<?php echo $form->labelEx($model,'title'); ?>
    	<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
    	<?php echo $form->error($model,'title'); ?>
    </div>
        

    <div class="row">
    	<?php echo $form->labelEx($model,'slug'); ?>
    	<?php echo $form->textField($model,'slug',array('size'=>60,'maxlength'=>255)); ?>
    	<?php echo $form->error($model,'slug'); ?>
    </div>
        

    <div class="row">
    	<?php echo $form->labelEx($model,'type'); ?>
    	<?php echo $form->textField($model,'type'); ?>
    	<?php echo $form->error($model,'type'); ?>
    </div>
        

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->