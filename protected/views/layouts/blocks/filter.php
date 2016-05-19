<?php 
   
   $list_city = Yii::app()->cache->get('list_city'); // Kiểm tra lấy từ cache
   if($list_city===false){
      $list_city = CHtml::listData(City::model()->findAll(array(
         'order' => 'position ASC',
         'condition' => 'status = 1 AND position <> 0',
      )),'id','name');
      Yii::app()->cache->set('list_city', $list_city, 3600);
   }
   
   $list_cate = Yii::app()->cache->get('list_cate'); // Kiểm tra lấy từ cache
   if($list_cate===false){
      $list_cate = CHtml::listData(Category::model()->findAll(array(
         'order' => 'position ASC'
      )),'id','name');
      Yii::app()->cache->set('list_cate', $list_cate, 3600);
   }
   
   $list_year = array(
      2012 => 2012,
      2013 => 2013,
      2014 => 2014,
      2015 => 2015
   );
   
   $list_order = array(
      'publish_date' => 'Mới cập nhật',
      'publish_year' => 'Năm xuất bản',
      'name' => 'Tên phim',
      'view' => 'Lượt xem',
   );
   
?>
<form class="form-filter" action="/film/filter" method="GET">
   <div class="filter-item">      
      <?php echo CHtml::dropDownList('order',$order_by,$list_order,array(
         'class' => 'input form-control',
         'empty' => '-- Sắp xếp --'
      ))?>
   </div>
   <div class="filter-item">
      <?php echo CHtml::dropDownList('cat_id',$cat_id,$list_cate,array(
         'class' => 'input form-control',
         'empty' => '-- Thể loại --'
      ))?>
   </div>
   <div class="filter-item">
      <?php echo CHtml::dropDownList('city_id',$city_id,$list_city,array(
         'class' => 'input form-control',
         'empty' => '-- Quốc gia --'
      ))?>
   </div>
   <div class="filter-item">
      <?php echo CHtml::dropDownList('year',$year,$list_year,array(
         'class' => 'input form-control',
         'empty' => '-- Năm --'
      ))?>
   </div>
   <input type="submit" class="btn btn-success" value="Lọc phim" />
</form>