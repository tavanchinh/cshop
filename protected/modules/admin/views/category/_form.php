<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    <div class="uk-grid">
        <div class="uk-width-1-4">
            <?php
                $all = Category::model()->getAll();
                $tree = Category::model()->getTree($all);
            ?>
        	<?php echo $form->labelEx($model,'parent_id'); ?>
        	<?php echo $form->dropDownList($model,'parent_id',$tree); ?>
        	<?php echo $form->error($model,'parent_id'); ?>
        </div>
        
        <div class="row uk-width-1-4">
        	<?php echo $form->labelEx($model,'name'); ?>
        	<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
        	<?php echo $form->error($model,'name'); ?>
        </div>
        
        <div class="row uk-width-1-2">
        	<?php echo $form->labelEx($model,'slug'); ?>
        	<?php echo $form->textField($model,'slug',array('size'=>60,'maxlength'=>255)); ?>
        	<?php echo $form->error($model,'slug'); ?>
        </div>
        
    </div>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    $(function(){
        $("#Category_name").keyup(function(){
            var str = $(this).val();
            str = removeSign(str);
            $("#Category_slug").val('/danh-muc-san-pham/'+str);
        })
    })
</script>