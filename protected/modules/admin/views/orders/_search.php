<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
    <div class="uk-grid">
        <div class="uk-width-1-10">
            <?php echo $form->label($model,'id'); ?>
            <?php echo $form->textField($model,'id'); ?>
        </div>
        <div class="uk-width-1-5">
    		<?php echo $form->label($model,'full_name'); ?>
    		<?php echo $form->textField($model,'full_name',array('size'=>60,'maxlength'=>255)); ?>
        </div>
        <div class="uk-width-1-5">
            <?php echo $form->label($model,'phone_number'); ?>
    		<?php echo $form->textField($model,'phone_number',array('size'=>11,'maxlength'=>11)); ?>
        </div>
        <div class="uk-width-1-5">
            <?php echo $form->label($model,'email'); ?>
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
        </div>
        <div class="uk-width-1-10">
            <div class="row buttons" style="margin-top: 15px;">
        		<?php echo CHtml::submitButton('Search'); ?>
        	</div>
        </div>
    </div>

	

<?php $this->endWidget(); ?>

</div><!-- search-form -->