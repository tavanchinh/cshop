<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
$this->breadcrumbs=array(
	'Tạo water marks',
);
?>

<h1>Upload and Add watermarks</h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'watermarks',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<div class="column">
    <?php echo CHtml::label('Chọn ảnh và tải lên','add_wtm'); ?>
      <?php 
      $img_src = '';
      $img_name = '';
      ?>
      <ul>
         <li class="item-upload relative" style="width: 400px;height: 400px;margin: 0 auto;">
            <i class="fa fa-picture-o" style="font-size: 320px;"></i>
            <input type="file" style="width: 380px; height: 380px;" class="general-input" stt="1" id="general-input-1" multiple="true" value="<?php echo $img_name?>" <?php echo ($img_name !='') ? 'disabled="disabled"' : '' ?> />
            <input type="hidden" value="0" name="watermarks" id="watermarks" />
            <input type="hidden" name="image" id="image" class="hidden-input" />
            <div class="absolute preview" style="<?php echo ($img_src !='') ? 'background-image:url('.$img_src.')' :''?>">
            </div>
            <?php if($img_src != '') echo '<i class="fa fa-times-circle"></i>'?>            
         </li>
      </ul>
      <textarea class="source" style="width: 270px;margin-right: 10px;"></textarea><span class="btn btn-get-link">Lấy link</span>
   </div>
<?php $this->endWidget(); ?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl?>/js/ajaxupload.js"></script>
<script>
   $(document).ready(function(){
      
      $(".general-input").ajaxupload({
         urlUpload:'/admin/default/uploadimage',
         watermarks:1,
      });
      
      $(document).on("click",".fa-times-circle", function(){
         $this = $(this);
         $this.parents(".item-upload").find("div.preview").css("background-image","none");
         $this.parents(".item-upload").find(".general-input").val('');       
         $this.parents(".item-upload").find(".hidden-input").val('');
         $this.parents(".item-upload").find(".general-input").prop("disabled",false);  
         $this.remove();
      });
      
      $(".btn-get-link").click(function(){
         var bg = $(".preview").css('background-image');
         
         var source = bg.replace('url(','').replace(')','');
         $(".source").val(source);
      });
      
   });
</script>

</div><!-- form -->