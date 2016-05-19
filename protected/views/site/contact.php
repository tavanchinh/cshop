<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>
<div class="main-content">
   <div class="container static-page">
      <div class="title">
         <p>Đóng góp ý kiến</p>
      </div>
      <div class="left-content">
         <div class="upload-film">
            <p class="note" style="margin-top: 0;">Bạn có yêu cầu hay muốn đóng góp ý kiến cho website của chúng tôi. Hãy điền đầy đủ nội dung vào mẫu dưới đây và gửi cho chúng tôi. Mỗi ý kiến của các bạn sẽ góp phần xây dựng website phát triển hơn.</p>
            <?php if(Yii::app()->user->hasFlash('success')){
               echo CHtml::tag('div',array('class' => 'message'),Yii::app()->user->getFlash('success'));
            }?>
            <?php $form=$this->beginWidget('CActiveForm',array(
               'id' => 'contact-form',
               'htmlOptions' => array('class' =>  'form'),
            ));?>
            <div class="row">
               <?php echo $form->labelEx($model,'name')?>
               <?php echo $form->textField($model,'name')?>
               <?php echo $form->error($model,'name')?>
         	</div>
            <div class="row">
               <?php echo $form->labelEx($model,'email')?>
               <?php echo $form->textField($model,'email')?>
               <?php echo $form->error($model,'email')?>
         	</div>
            <div class="row">
               <?php echo $form->labelEx($model,'phone_number')?>
               <?php echo $form->textField($model,'phone_number')?>
               <?php echo $form->error($model,'phone_number')?>
         	</div>
            <div class="row">
               <?php echo $form->labelEx($model,'content')?>
               <?php echo $form->textArea($model,'content',array('rows'=>6))?>
               <?php echo $form->error($model,'content')?>
         	</div>
            <div class="captcha-container"  style="margin: 0 0 0 180px;">
               <div class="image">
                  <img class="captcha" id="img_captcha" src="/site/captchacontact" />
                  <i class="refresh-captcha fa fa-refresh" onclick="$('#img_captcha').attr('src','/site/captchacontact');" title="Lấy mã khác"></i>
               </div>
               <div class="clear"></div>
               <div class="input-container"> 
                  <div class="left">
                     <div class="label">Nhập mã xác nhận</div>
                     <?php echo $form->textField($model,'verifyCode',array(
                        'id' => 'ip_captcha',
                     )); ?>
                     
                  </div>                 
               </div>
               <?php echo $form->error($model,'verifyCode'); ?>
            </div>
            <div class="row">
               <?php echo CHtml::submitButton('Gửi',array('class' => 'btn btn-submit'))?>
            </div>
            <?php $this->endWidget()?>
         </div>
      </div>
      <div class="right-content">
      <?php $this->renderPartial('/layouts/blocks/right_block');?>
      </div>
   </div>
</div>