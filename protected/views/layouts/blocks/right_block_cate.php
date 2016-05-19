<?php $baseUrl = Yii::app()->request->baseUrl?>
<div class="calendar">
   <script type="text/javascript" src="/js/amlich-hnd.js">
   </script>
   <script>
      setOutputSize("small");
      document.write(printSelectedMonth());
   </script>
</div>
<div class="news-update block-small">
   <?php 
      $criteria = new CDbCriteria();
      $criteria->addCondition('active = 1');
      $criteria->limit = 8;
      $criteria->order = 'id DESC';
      $news_update = News::model()->findAll($criteria);
   ?>
   <div class="heading">
      <span>Vừa cập nhật</span>
   </div>
   <ul class="list-news">
      <?php foreach($news_update as $value){
         $link = News::model()->getDetailLink($value->id,$value->title);
         $post_time = MyDatetime::getTimeAgo(strtotime($value->create_date));
         ?>
         <li class="news-item">
            <a href="<?php echo $link?>">
               <div class="img-wrap left">
                  <img alt="<?php echo $value->title?>" src="<?php echo $baseUrl.'/uploads/pictures/news/s_' . $value->image?>" />
               </div>
               <div class="title">
                  <span><?php echo $value->title;?></span>
               </div>
               <div class="post-time">
                  <span class="glyphicon glyphicon-time"></span>
                  <span><?php echo $post_time?></span>
               </div>
            </a>
         </li>
      <?php }?>
      
   </ul>
</div>

<div class="box-like-fb">
   <div class="fb-like-box" data-href="https://www.facebook.com/FacebookDevelopers" data-width="100%" data-height="300" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
</div>

<div class="block-news-tabs block-small">
   <ul class="tab-label-container">
      <li data-link="#tab-most-read" class="tab-label uppercase roboto active" onclick="tabs(this,'.tab-label','.tab-content')">Đọc nhiều</li>
      <li data-link="#tab-hottest" class="tab-label uppercase roboto" onclick="tabs(this,'.tab-label','.tab-content')">Nhiều phản hồi</li>
   </ul>
   <ul class="content">
      <li class="tab-content" id="tab-most-read">
         <ul class="list-news">
            <?php foreach($news_update as $value){
               $link = News::model()->getDetailLink($value->id,$value->title);
               ?>
               <li class="news-item">
                  <a href="<?php echo $link?>">
                     <div class="img-wrap left">
                        <img alt="<?php echo $value->title?>" src="<?php echo $baseUrl.'/uploads/pictures/news/s_' . $value->image?>" />
                     </div>
                     <div class="title">
                        <span><?php echo $value->title?></span>
                     </div>
                     <div class="view-comment">
                        <span class="glyphicon glyphicon-eye-open"></span>
                        <span><?php echo $value->view?></span>
                     </div>
                  </a>
               </li>
            <?php }?>
         </ul>
      </li>
      <li class="tab-content hide" id="tab-hottest">
         <ul class="list-news">
            <?php foreach($news_update as $value){
               $link = News::model()->getDetailLink($value->id,$value->title);
               ?>
               <li class="news-item">
                  <a href="<?php echo $link?>">
                     <div class="img-wrap left">
                        <img alt="<?php echo $value->title?>" src="<?php echo $baseUrl.'/uploads/pictures/news/s_' . $value->image?>" />
                     </div>
                     <div class="title">
                        <span><?php echo $value->title?></span>
                     </div>
                     <div class="view-comment">
                        <span class="glyphicon glyphicon-comment"></span>
                        <span><?php echo $value->comment?></span>
                     </div>
                  </a>
               </li>
            <?php }?>
         </ul>
      </li>
   </ul>
</div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&appId=174176739397727&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>