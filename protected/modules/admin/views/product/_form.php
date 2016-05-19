<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div style="clear: both;">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
    <div class="uk-grid">
        <div class="uk-width-3-4">
            <div class="md-card">
                <div class="md-card-content">
                    <div class="row">
                    	<?php echo $form->labelEx($model,'title'); ?>
                    	<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
                    	<?php echo $form->error($model,'title'); ?>
                    </div>
                </div>
            </div>
            
            <div class="md-card">
                <div class="md-card-toolbar">
            		<h3 class="md-card-toolbar-heading-text"><?php echo $form->labelEx($model,'description'); ?></h3>
                </div>
                <div class="md-card-content">
                    <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
            		<?php echo $form->error($model,'description'); ?>
                </div>
            </div>
            
            <div class="md-card">
                <div class="md-card-toolbar">
            		<h3 class="md-card-toolbar-heading-text">Thuộc tính</h3>
                </div>
                <div class="md-card-content">
                    <div class="row">
                    	<?php echo $form->labelEx($model,'sku'); ?>
                    	<?php echo $form->textField($model,'sku',array('size'=>60,'maxlength'=>255)); ?>
                    	<?php echo $form->error($model,'sku'); ?>
                    </div>
                        
                    <div class="row">
                    	<?php echo $form->labelEx($model,'price'); ?>
                    	<?php echo $form->textField($model,'price',array('placeholder' => 'đ')); ?>
                    	<?php echo $form->error($model,'price'); ?>
                    </div>
                    
                    <div class="row">
                    	<?php echo $form->labelEx($model,'sale'); ?>
                    	<?php echo $form->textField($model,'sale',array('placeholder' => '%')); ?>
                    	<?php echo $form->error($model,'sale'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-width-1-4">
            
        </div>
    </div>
    
	<?php echo $form->errorSummary($model); ?>
    
    
        

    <div class="row">
    	<?php echo $form->labelEx($model,'image'); ?>
    	<?php echo $form->textField($model,'image',array('size'=>60,'maxlength'=>255)); ?>
    	<?php echo $form->error($model,'image'); ?>
    </div>
        

    
        


    <div class="row">
    	<?php echo $form->labelEx($model,'modify_date'); ?>
    	<?php echo $form->textField($model,'modify_date'); ?>
    	<?php echo $form->error($model,'modify_date'); ?>
    </div>
        

    <div class="row">
    	<?php echo $form->labelEx($model,'create_by'); ?>
    	<?php echo $form->textField($model,'create_by'); ?>
    	<?php echo $form->error($model,'create_by'); ?>
    </div>
        

    <div class="row">
    	<?php echo $form->labelEx($model,'modify_by'); ?>
    	<?php echo $form->textField($model,'modify_by'); ?>
    	<?php echo $form->error($model,'modify_by'); ?>
    </div>
        

    <div class="row">
    	<?php echo $form->labelEx($model,'feature'); ?>
    	<?php echo $form->textField($model,'feature'); ?>
    	<?php echo $form->error($model,'feature'); ?>
    </div>
        

    
    <script>
        $(function(){
            CKEDITOR.replace('Product_description',{
                width:'100%',
            });
        })
    </script>
        

    <div class="row">
    	<?php echo $form->labelEx($model,'status'); ?>
    	<?php echo $form->textField($model,'status'); ?>
    	<?php echo $form->error($model,'status'); ?>
    </div>
        

    <div class="row">
    	<?php echo $form->labelEx($model,'stock'); ?>
    	<?php echo $form->textField($model,'stock'); ?>
    	<?php echo $form->error($model,'stock'); ?>
    </div>
        

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->