<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */
?>

<div style="clear: both;">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'page-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    <div class="uk-grid">
        <div class="uk-width-3-4">
            <div class="md-card">
                <div class="md-card-content">
                    <div class="row">
                    	<?php echo $form->labelEx($model,'name'); ?>
                    	<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
                    	<?php echo $form->error($model,'name'); ?>
                    </div>
                    
                    <div class="row">
                    	<?php echo $form->labelEx($model,'slug'); ?>
                    	<?php echo $form->textField($model,'slug',array('size'=>60,'maxlength'=>255)); ?>
                    	<?php echo $form->error($model,'slug'); ?>
                    </div>
                </div>
            </div>
            
            <div class="md-card">
                <div class="md-card-toolbar">
            		<h3 class="md-card-toolbar-heading-text"><?php echo $form->labelEx($model,'content'); ?></h3>
                </div>
                <div class="md-card-content">
                    <?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
            		<?php echo $form->error($model,'content'); ?>
                </div>
            </div>
        </div>
        <div class="uk-width-1-4">
            <div class="md-card">
            	<div class="md-card-content">
                    
                    <div class="uk-margin-bottom checkbox checkbox-slider-md checkbox-slider--b-flat">
                        <label>
                            <?php echo $form->checkBox($model,'status');?>
                            <span>Hiển thị</span>
                        </label>
                    </div>
                    
                    
                </div>
            </div>
            <div class="md-card">
            	<div class="md-card-content">
                    <div class="row">
                        <div>Layout</div>
                    	<?php echo $form->dropDownList($model,'layout',Page::model()->list_layout); ?>
                    	
                    </div>
                </div>
            </div>
            
            <div class="md-card">
            	<div class="md-card-content">
                    <div class="buttons">
                		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'md-btn md-btn-small md-btn-success')); ?>
                	</div>
                </div>
            </div>
        </div>
    </div>
    

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    $(function(){
        CKEDITOR.replace('Page_content',{
            width:'100%',
        });
        
        $("#Page_name").keyup(function(){
            var str = $(this).val();
            str = removeSign(str);
            $("#Page_slug").val('/'+str);
        })
    })
</script>