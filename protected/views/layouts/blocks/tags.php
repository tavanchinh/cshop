<?php $detect_mobile = new Mobile_Detect;
if(!$detect_mobile->isMobile()){
?>
<?php 

$list_tag=false;//Yii::app()->cache->get('list_tag');
if($list_tag===false)
{
   $criteria = new CDbCriteria();
   $criteria->addCondition('display_home = 1');
   $criteria->order = 'id DESC';
   $list_tag = Tag::model()->findAll($criteria);
   Yii::app()->cache->set('list_tag', $list_tag, 3600);
}
?>
<div class="block tagcloud">
   <div class="caption">
      <span class="uppercase"><i class="fa fa-tags"></i>Tags</span>
   </div>
   <ul class="tags">
      <?php foreach($list_tag as $value){
         $link = '/tag/'.CVietnameseTools::makeUrlFriendly($value->name).'-'.$value->id.'.html';
         ?>
         <li class="tag-item"><a class="level-<?php echo rand(2,10)?>" href="<?php echo $link?>" title="<?php echo $value->name?>"><?php echo $value->name?></a></li>
      <?php }?>
   </ul>
</div>
<?php }?>