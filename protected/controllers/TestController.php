<?php 
class TestController extends CController{
    public function actionIndex(){
        $loginUrl = Yii::app()->facebook->getLoginUrl();
        var_dump($loginUrl);die;
    }    
}

?>