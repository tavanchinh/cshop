<?php
/* @var $this MembergroupController */
/* @var $model Membergroup*/
$this->breadcrumbs = array(
   'Quản lý nhóm' => '/index.php/admin/'.$this->id,
	'Sửa nhóm',
);

?>
<h1>Sửa nhóm</h1>
<div class="form" id="<?php echo Yii::app()->controller->id . '-' . Yii::app()->controller->action->id?>">
<?php
   $form = $this->beginWidget('CActiveForm',array(
      'enableClientValidation' => true,
      'clientOptions'=>array(
   		'validateOnSubmit'=>true,
   	),
      'id' => Yii::app()->controller->id . '_' . Yii::app()->controller->action->id )
   );
?>
   <p class="note">Những dòng đánh dấu <span class="required">*</span> là bắt buộc.</p>

	<?php echo $form->errorSummary($model,'Kiểm tra lại các giá trị bạn vừa nhập vào'); 
      if($message != ''){
         echo CHtml::tag('div', array('class'=>'message-success'),$message);
      }
   ?>
   <input name="session_user" type="hidden" value="<?php echo $session_user?>"/>
   <input name="action_user" type="hidden" value="" id="action_user" />
   <table>
      <tr>
         <td style="width: 150px;"><?php echo $form->labelEx($model, 'MembergroupName');?></td>
         <td><?php echo $form->textField($model, 'MembergroupName');?></td>
      </tr>
      <tr>
         <td style="width: 150px;"><?php echo $form->labelEx($model, 'IsActive');?></td>
         <td><?php echo $form->checkBox($model, 'IsActive',array('checked' => 'checked'));?></td>
      </tr>
   </table>
<?php $this->endWidget(); ?>
</div>