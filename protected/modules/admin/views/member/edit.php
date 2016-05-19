<?php
/* @var $this MemberController */
/* @var $model Member*/
$this->breadcrumbs = array(
   'Quản lý tài khoản' => '/index.php/admin/'.$this->id,
   'Cập nhật tài khoản'
);

?>
<div class="form" id="<?php echo Yii::app()->controller->id . '-' . Yii::app()->controller->action->id?>">
<?php
   $form = $this->beginWidget('CActiveForm',array(
      'enableClientValidation' => true,
      'clientOptions'=>array(
   		'validateOnSubmit'=>true,
   	),
      'htmlOptions' => array('class' => 'form-horizontal'),
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
   <div class="control-group">
      <?php echo $form->labelEx($model, 'MemberGroupID',array('class'  => 'control-label'));?>
      <div class="controls">
         <?php echo $form->dropDownList($model, 'MemberGroupID',$list_group);?>
      </div>
   </div>
   <div class="form-actions">
      <?php echo CHtml::submitButton('Lưu',array('class' => 'btn btn-info'))?>
      <?php echo CHtml::resetButton('Hủy',array('class' => 'btn btn-warning' ,'onclick' => 'window.history.go(-1)'))?>
	</div>
<?php $this->endWidget(); ?>
</div>
<script>
   $(document).ready(function(){
      $(".datepicker").datepicker({
         dateFormat:"dd/mm/yy",
         defaultDate: '01/01/1991'
      });
   });
</script>