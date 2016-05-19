<a id="login-fb" href="https://www.facebook.com/dialog/oauth?client_id=<?php echo $app_id?>&redirect_uri=<?php echo $redirect_uri?>">
   <img src="<?php echo Yii::app()->request->baseUrl.'/images/login_fb.png'?>"/>
</a>
<script>
   $(document).ready(function(){
      $("#login-fb").click(function(){
         
      });
   })
</script>
