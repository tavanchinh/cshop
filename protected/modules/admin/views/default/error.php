<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
$error_data = array(
   404 => 'Trang bạn tìm kiếm không tồn tại',
   403 => 'Bạn không có quyền thực hiện hành động này. Vui lòng liên hệ với Admin!',
   );
?>
<div class="text-error">
    <div class="uk-alert uk-alert-danger">
        <?php echo '('.$code.')';?>
        <?php echo  isset($error_data[$code]) ? CHtml::encode($error_data[$code]) : CHtml::encode($message); ?>
        
        <?php echo '('.$message.')';?>
    </div>
</div>