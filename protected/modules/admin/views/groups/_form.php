<?php
/* @var $this GroupsController */
/* @var $model Groups */
/* @var $form CActiveForm */
?>

<div style="clear: both;">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'groups-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
    <div class="uk-grid">
        <div class="uk-width-1-2">
            <div class="md-card">
                <div class="md-card-content">
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
                </div>
            </div>
        </div>
        
        <div class="uk-width-1-2">
            <div class="md-card">
                <div class="md-card-content">
                        <?php 
                        $list_all = Functional::model()->getMultilevel();
                        
                        if($model->id != null){
                            $list_selected = Groups::model()->getFuncIDSelected($model->id);        
                        }else{
                            $list_selected = array();
                        }
                        
                        if(count($list_all) > 0){?>
                            <ul class="checklist">
                                <?php foreach($list_all as $value){?>
                                    <li>
                                        <label>
                                            <input type="checkbox" name="functions[]" <?php echo (in_array($value['id'],$list_selected)) ? 'checked' : ''?> value="<?php echo $value['id']?>" />
                                            <?php echo $value['name']?>
                                        </label>
                                        <?php if(isset($value['sub'])){?>
                                        <ul class="children">
                                            <?php foreach($value['sub'] as $sub){?>
                                                <li>
                                                    <label>
                                                        <input type="checkbox" name="functions[]" <?php echo (in_array($sub['id'],$list_selected)) ? 'checked' : ''?> value="<?php echo $sub['id']?>" />
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
            </div>
        </div>
    </div>
    
	<?php echo $form->errorSummary($model); ?>

<<<<<<< HEAD
	
=======
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
>>>>>>> d6cc804a7f6d979e0e4f3b19953764fe0b56a31b
    
	<div class="row buttons uk-margin-top uk-text-right">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'md-btn md-btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    $(document).ready(function(){
        $(".checklist input").click(function(){
            $this = $(this);
            var parent = $this.parents('li').eq(0);
            if($this.is(':checked')){
                parent.find('.children input').prop('checked',true);    
            }else{
                parent.find('.children input').prop('checked',false);
            }
            
        });
    });
</script>