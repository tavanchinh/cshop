<?php 
    class CaptchaController extends Controller{
        public function actionLogin(){
            $captcha = new Captcha();
            $captcha->session_var = 'captcha_backend';
            $captcha->text_color = '#ffffff';
            $captcha->line_color = '#ffffff';
            $captcha->background_color = '#4E7197';
            $captcha->CreateImage();
        }
    }
?>