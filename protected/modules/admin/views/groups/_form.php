<?php
/* @var $this GroupsController */
/* @var $model Groups */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'groups-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'des'); ?>
		<?php echo $form->textField($model,'des',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'des'); ?>
	</div>
   
   <div class="row">
      <?php 
         $list_functional = CHtml::listData(Functional::model()->findAll(),'id','name');
         $str_fnc_id = '';
         if($model->id != null){
            $fnc_selected = GroupFunctional::model()->findAllByAttributes(array(
               'group_id' => $model->id,
            ));
            
            if(count($fnc_selected) > 0){
               foreach($fnc_selected as $value){
                  $str_fnc_id .= $value->functional_id .',';
               }
               $str_fnc_id = substr($str_fnc_id,0,-1);
            }
         }
      ?>
      <?php echo CHtml::label('Quyền thao tác','film_cat')?>
      <?php echo CHtml::dropDownList('Groups[functional]','',$list_functional,array(
         'multiple' => 'multiple',
         'style' => 'width:700px'
      ));?>
   </div>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
   $(document).ready(function(){
      $("#Groups_functional").val([<?php echo $str_fnc_id?>]).select2({
         lang:'vi',
         allowClear: true,
      });
      
      
   });
</script>