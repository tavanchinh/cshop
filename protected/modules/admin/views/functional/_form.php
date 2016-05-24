<?php
/* @var $this FunctionalController */
/* @var $model Functional */
/* @var $form CActiveForm */
?>

<div style="clear: both;">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'functional-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    <div class="md-card">
        <div class="md-card-content">
            <div class="row">
        		<?php echo $form->labelEx($model,'name'); ?>
        		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
        		<?php echo $form->error($model,'name'); ?>
        	</div>
        
        	<div class="row">
        		<?php echo $form->labelEx($model,'url'); ?>
        		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
        		<?php echo $form->error($model,'url'); ?>
        	</div>
            
            <div class="row">
<<<<<<< HEAD
                <?php $list_parent = Functional::model()->getListParent();
                $list_parent[0] = '-- Không chọn --';
                ?>
                <?php echo $form->labelEx($model,'parent_id'); ?>
        		<?php echo $form->dropDownList($model,'parent_id',$list_parent); ?>
=======
                <?php $list_parent = Functional::model()->getListParent();?>
                <?php echo $form->labelEx($model,'parent_id'); ?>
        		<?php echo $form->dropDownList($model,'parent_id',$list_parent,array('empty' => '-- Không chọn --')); ?>
>>>>>>> d6cc804a7f6d979e0e4f3b19953764fe0b56a31b
            </div>
        </div>
    </div>
	
	<div class="row buttons uk-text-right uk-margin-top">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'md-btn md-btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->