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
   
   <div class="md-card-content">
        <?php 
        $list_all = Functional::model()->getMultilevel();
        
        if($model->id != null){
            $list_selected = GroupFunctional::model()->findAllByAttributes(array(
               'group_id' => $model->id,
            ));    
        }else{
            $list_selected = array();
        }
        
        
        if(count($list_all) > 0){?>
            <ul class="checklist">
                <?php foreach($list_all as $value){?>
                    <li>
                        <label>
                            <input type="checkbox" name="categories[]" <?php echo (in_array($value['id'],$list_selected)) ? 'checked' : ''?> value="<?php echo $value['id']?>" />
                            <?php echo $value['name']?>
                        </label>
                        <?php if(isset($value['sub'])){?>
                        <ul class="children">
                            <?php foreach($value['sub'] as $sub){?>
                                <li>
                                    <label>
                                        <input type="checkbox" name="categories[]" <?php echo (in_array($sub['id'],$list_selected)) ? 'checked' : ''?> value="<?php echo $sub['id']?>" />
                                        <?php echo $sub['name']?>
                                    </label>
                                </li>
                            <?php }?>
                        </ul>
                        <?php }?>
                    </li>
                <?php }?>
            </ul>
        <?php }
        ?>
    </div>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
   $(document).ready(function(){
      
   });
</script>