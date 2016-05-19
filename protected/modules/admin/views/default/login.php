<?php 
$baseUrl = Yii::app()->request->baseUrl;
?>
<div class="login_page_wrapper">
    <div class="md-card" id="login_card">
        <div class="md-card-content large-padding" id="login_form">
            <div class="login_heading">
                <div class="user_avatar"></div>
            </div>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'form_validation',
                'enableClientValidation' => false,
                'clientOptions' => array(
                    'validateOnSubmit' => false
                ),
            ));
            ?>
            <form id="form_validation" action="/admin/default">
                <div class="parsley-row uk-form-row">
                    <label for="LoginForm_username">Username<span class="req">*</span></label>
                    <?php echo $form->textField($model,'username',array('class' => 'md-input','required' => true)); ?>
                </div>
                <div class="parsley-row uk-form-row">
                    <label for="LoginForm_password">Password<span class="req">*</span></label>
                    <?php echo $form->passwordField($model,'password',array('class' => 'md-input','required' => true)); ?>
                    <?php echo $form->error($model,'password'); ?>
                </div>
                <div class="captcha-container parsley-row uk-form-row">
                     <div class="image" style="margin-bottom: 10px;">
                        <img class="captcha" id="img_captcha" src="/admin/default/captcha" />
                        <img class="refresh-captcha" src="/assets/admin/images/reload.png" onclick="$('#img_captcha').attr('src','/admin/default/captcha');" title="Lấy mã khác" style="background: #2196F3;padding: 8px;cursor: pointer;" />
                     </div>
                     <div style="clear: both;"></div>
                     <div class="input-container"> 
                        <div class="left">
                           <label for="ip_captcha">Captcha<span class="req">*</span></label>
                           <?php echo $form->textField($model,'verifyCode',array(
                              'class' => 'md-input',
                              'required' => true,
                           )); ?>
                           <?php echo $form->error($model,'verifyCode'); ?>
                        </div>                 
                     </div>
                </div>
                <div class="uk-margin-medium-top">
                    <button class="md-btn md-btn-primary md-btn-block md-btn-large">Sign in</button>
                </div>
                <div class="uk-margin-top">
                    <a href="#" id="login_help_show" class="uk-float-right">Need help?</a>
                </div>
            <?php $this->endWidget(); ?>
        </div>
        <div class="md-card-content large-padding uk-position-relative" id="login_help" style="display: none">
            <button type="button" class="uk-position-top-right uk-close uk-margin-right uk-margin-top back_to_login"></button>
            <h2 class="heading_b uk-text-success">Không thể đăng nhập ?</h2>
            <p>Dưới đây là các thông tin để giúp bạn đăng nhập vào tài khoản của bạn nhanh nhất.</p>
            <p>Đầu tiên, hãy thử những điều đơn giản nhất: nếu bạn nhớ mật khẩu của bạn, nhưng nó không làm việc, hãy chắc chắn rằng Caps Lock được tắt, và rằng tên người dùng của bạn được viết đúng chính tả, và sau đó thử lại.</p>
            <p>Nếu mật khẩu của bạn vẫn không hoạt động. Bạn hãy liên hệ với BQT</a>.</p>
        </div>
        
    </div>
    <!-- common functions -->
    <script src="<?php echo $baseUrl?>/assets/admin/js/common.min.js"></script>
    <!-- altair core functions -->
    <script src="<?php echo $baseUrl?>/assets/admin/js/altair_admin_common.min.js"></script>

    <!-- altair login page functions -->
    <script src="<?php echo $baseUrl?>/assets/admin/js/login.min.js"></script>
    <!-- parsley (validation) -->
    <script>
    // load parsley config (altair_admin_common.js)
    altair_forms.parsley_validation_config();
    </script>
    <script src="<?php echo $baseUrl?>/assets/admin/components/parsleyjs/dist/parsley.min.js"></script>

    <!--  forms validation functions -->
    <script src="<?php echo $baseUrl?>/assets/admin/js/forms_validation.min.js"></script>
</div>