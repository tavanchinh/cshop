<?php
/* @var $this MemberController */
/* @var $model Member */
/* @var $form CActiveForm */
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

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
   <div class="row">
      <?php 
         $list_group = CHtml::listData(Groups::model()->findAll(),'id','name');
         $str_group_id = '';
         if($model->id != null){
            $group_selected = MemberGroup::model()->findAllByAttributes(array(
               'member_id' => $model->id,
            ));
            
            if(count($group_selected) > 0){
               foreach($group_selected as $value){
                  $str_group_id .= $value->group_id .',';
               }
               $str_group_id = substr($str_group_id,0,-1);
            }
         }
      ?>
      <?php echo CHtml::label('Nhóm','film_cat')?>
      <?php echo CHtml::dropDownList('Member[groups]','',$list_group,array(
         'multiple' => 'multiple',
         'style' => 'width:700px'
      ));?>
   </div>
   
	<div class="row">
		<?php echo $form->labelEx($model,'display_name'); ?>
		<?php echo $form->textField($model,'display_name',array('size'=>50,'maxlength'=>50,'style' => 'width:180px')); ?>
		<?php echo $form->error($model,'display_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_name'); ?>
		<?php echo $form->textField($model,'user_name',array('size'=>50,'maxlength'=>50,'style' => 'width:180px')); ?>
		<?php echo $form->error($model,'user_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>32,'maxlength'=>32,'style' => 'width:180px')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
   
   <div class="row">
		<?php echo $form->labelEx($model,'repeat_password'); ?>
		<?php echo $form->passwordField($model,'repeat_password',array('size'=>32,'maxlength'=>32,'style' => 'width:180px')); ?>
		<?php echo $form->error($model,'repeat_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone_number'); ?>
		<?php echo $form->textField($model,'phone_number',array('size'=>20,'maxlength'=>20,'style' => 'width:180px')); ?>
		<?php echo $form->error($model,'phone_number'); ?>
	</div>

   <div class="row">
		<?php echo $form->labelEx($model,'is_admin'); ?>
		<?php echo $form->checkBox($model,'is_admin',array('checked' => 1)); ?>
		<?php echo $form->error($model,'is_admin'); ?>
	</div>
   
	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->checkBox($model,'status',array('checked' => 1)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
   $(document).ready(function(){
      $("#Member_groups").val([<?php echo $str_group_id?>]).select2({
         lang:'vi',
         allowClear: true,
      });
   });
</script>