<?php
/* @var $this WebconfigController */
/* @var $model WebConfig */
/* @var $form CActiveForm */
?>

<div style="clear: both;">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'web-config-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'    
    ),
    
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    
    <div class="md-card">
        <div class="md-card-toolbar">
            <div class="md-card-toolbar-actions">
                <i class="md-icon material-icons md-card-toggle"></i>
            </div>
            <h3 class="md-card-toolbar-heading-text">General</h3>
        </div>
        <div class="md-card-content">
            <div class="row">
            	<?php echo $form->labelEx($model,'web_title'); ?>
            	<?php echo $form->textField($model,'web_title',array('size'=>60,'maxlength'=>255)); ?>
            	<?php echo $form->error($model,'web_title'); ?>
            </div>
            
            <div class="row">
                <label>Logo</label>
                <div class="uk-float-left">
                    <img style="width: 150px;margin-bottom: 5px;" src="/images/logo.png" />
                    <input type="file" name="logo" />
                </div>
            </div>
                
            <div class="row">
            	<?php echo $form->labelEx($model,'meta_keyword'); ?>
            	<?php echo $form->textField($model,'meta_keyword',array('size'=>60,'maxlength'=>512)); ?>
            	<?php echo $form->error($model,'meta_keyword'); ?>
            </div>
        </div>
    </div>
    
    <div class="md-card">
        <div class="md-card-toolbar">
            <div class="md-card-toolbar-actions">
                <i class="md-icon material-icons md-card-toggle"></i>
            </div>
            <h3 class="md-card-toolbar-heading-text">Description</h3>
        </div>
        <div class="md-card-content">
            <div class="row">
            	<?php echo $form->textArea($model,'meta_description',array('class' => 'md-input','maxlength'=>512)); ?>
            	<?php echo $form->error($model,'meta_description'); ?>
            </div>
        </div>
    </div>
    
    <div class="md-card">
        <div class="md-card-toolbar">
            <div class="md-card-toolbar-actions">
                <i class="md-icon material-icons md-card-toggle"></i>
            </div>
            <h3 class="md-card-toolbar-heading-text">Social</h3>
        </div>
        <div class="md-card-content">
            <div class="row">
            	<?php echo $form->labelEx($model,'fanpage_url'); ?>
            	<?php echo $form->textField($model,'fanpage_url',array('size'=>60,'maxlength'=>255)); ?>
            	<?php echo $form->error($model,'fanpage_url'); ?>
            </div>
                
        
            <div class="row">
            	<?php echo $form->labelEx($model,'secret_id'); ?>
            	<?php echo $form->textField($model,'secret_id',array('size'=>60,'maxlength'=>255)); ?>
            	<?php echo $form->error($model,'secret_id'); ?>
            </div>
                
        
            <div class="row">
            	<?php echo $form->labelEx($model,'app_id'); ?>
            	<?php echo $form->textField($model,'app_id',array('size'=>60,'maxlength'=>255)); ?>
            	<?php echo $form->error($model,'app_id'); ?>
            </div>
            
            <div class="row">
            	<?php echo $form->labelEx($model,'youtube_url'); ?>
            	<?php echo $form->textField($model,'youtube_url',array('size'=>60,'maxlength'=>255)); ?>
            	<?php echo $form->error($model,'youtube_url'); ?>
            </div>
        </div>
    </div>
    
    <div class="md-card">
        <div class="md-card-toolbar">
            <div class="md-card-toolbar-actions">
                <i class="md-icon material-icons md-card-toggle"></i>
            </div>
            <h3 class="md-card-toolbar-heading-text">Support</h3>
        </div>
        <div class="md-card-content">
            <div class="row">
            	<?php echo $form->labelEx($model,'email'); ?>
            	<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
            	<?php echo $form->error($model,'email'); ?>
            </div>
                
        
            <div class="row">
            	<?php echo $form->labelEx($model,'hotline'); ?>
            	<?php echo $form->textField($model,'hotline',array('size'=>60,'maxlength'=>255)); ?>
            	<?php echo $form->error($model,'hotline'); ?>
            </div>
           
        </div>
    </div>
    
    
	<div class="row buttons uk-text-right uk-margin-top">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'md-btn md-btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->