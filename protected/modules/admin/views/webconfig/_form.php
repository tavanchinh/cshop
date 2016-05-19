<?php
/* @var $this WebconfigController */
/* @var $model WebConfig */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/ckeditor/ckeditor.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/ckeditor/config.js');

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'web-config-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'web_title'); ?>
		<?php echo $form->textField($model,'web_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'web_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta_description'); ?>
		<?php echo $form->textArea($model,'meta_description',array('size'=>60,'maxlength'=>512)); ?>
		<?php echo $form->error($model,'meta_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta_keyword'); ?>
		<?php echo $form->textArea($model,'meta_keyword',array('size'=>60,'maxlength'=>512)); ?>
		<?php echo $form->error($model,'meta_keyword'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'text_suggest_click_ads'); ?>
		<?php echo $form->textArea($model,'text_suggest_click_ads',array('size'=>60,'maxlength'=>512)); ?>
		<?php echo $form->error($model,'text_suggest_click_ads'); ?>
	</div>
   
   <div class="row">
		<?php echo $form->labelEx($model,'tag_footer_homepage'); ?>
		<?php echo $form->textArea($model,'tag_footer_homepage'); ?>
		<?php echo $form->error($model,'tag_footer_homepage'); ?>
	</div>

   <div class="row">
     <?php echo $form->labelEx($model,'contact_ads'); ?>
     <?php echo $form->textArea($model,'contact_ads',array('rows'=>6, 'cols'=>50)); ?>
     <?php echo $form->error($model,'contact_ads'); ?>
   </div>
   
   <div class="row">
     <?php echo $form->labelEx($model,'cooperate_content'); ?>
     <?php echo $form->textArea($model,'cooperate_content',array('rows'=>6, 'cols'=>50)); ?>
     <?php echo $form->error($model,'cooperate_content'); ?>
   </div>
   
   <div class="row">
     <?php echo $form->labelEx($model,'copyright_content'); ?>
     <?php echo $form->textArea($model,'copyright_content',array('rows'=>6, 'cols'=>50)); ?>
     <?php echo $form->error($model,'copyright_content'); ?>
   </div>
   
   <div class="row">
     <?php echo $form->labelEx($model,'general_rule'); ?>
     <?php echo $form->textArea($model,'general_rule',array('rows'=>6, 'cols'=>50)); ?>
     <?php echo $form->error($model,'general_rule'); ?>
   </div>
   
   <div class="row">
		<?php echo $form->labelEx($model,'allow_feedback'); ?>
		<?php echo $form->checkBox($model,'allow_feedback'); ?>
		<?php echo $form->error($model,'allow_feedback'); ?>
	</div>
   
   <div class="row">
		<?php echo $form->labelEx($model,'show_box_like'); ?>
		<?php echo $form->checkBox($model,'show_box_like'); ?>
		<?php echo $form->error($model,'show_box_like'); ?>
	</div>
   
   <div class="row">
		<?php echo $form->labelEx($model,'allow_comment_fb'); ?>
		<?php echo $form->checkBox($model,'allow_comment_fb'); ?>
		<?php echo $form->error($model,'allow_comment_fb'); ?>
	</div>
   
   <div class="row">
		<?php echo $form->labelEx($model,'allow_comment_system'); ?>
		<?php echo $form->checkBox($model,'allow_comment_system'); ?>
		<?php echo $form->error($model,'allow_comment_system'); ?>
	</div>
   
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
   $(document).ready(function(){
      CKEDITOR.replace('WebConfig_tag_footer_homepage',{
         height:100,
      });
      CKEDITOR.replace('WebConfig_general_rule',{
         height:150,
      });
      CKEDITOR.replace('WebConfig_copyright_content',{
         height:150,
      });
      CKEDITOR.replace('WebConfig_cooperate_content');
      CKEDITOR.replace('WebConfig_contact_ads');
   })
</script>