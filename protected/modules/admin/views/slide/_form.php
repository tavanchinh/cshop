<?php
/* @var $this SlideController */
/* @var $model Slide */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'slide-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
    	<?php echo $form->labelEx($model,'title'); ?>
    	<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
    	<?php echo $form->error($model,'title'); ?>
    </div>
        

    <div class="row">
    	<?php echo $form->labelEx($model,'link'); ?>
    	<?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>255)); ?>
    	<?php echo $form->error($model,'link'); ?>
    </div>
        

    <div class="row">
    	<?php echo $form->labelEx($model,'image'); ?>
    	<?php echo $form->textField($model,'image',array('size'=>60,'maxlength'=>255)); ?>
    	<?php echo $form->error($model,'image'); ?>
    </div>
        

    <div class="row">
    	<?php echo $form->labelEx($model,'status'); ?>
    	<?php echo $form->textField($model,'status'); ?>
    	<?php echo $form->error($model,'status'); ?>
    </div>
        

    <div class="row">
    	<?php echo $form->labelEx($model,'position'); ?>
    	<?php echo $form->textField($model,'position'); ?>
    	<?php echo $form->error($model,'position'); ?>
    </div>
        

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->