<?php
/* @var $this SlideController */
/* @var $model Slide */

$this->breadcrumbs=array(
	'Slides'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Slide', 'url'=>array('index')),
	array('label'=>'Create Slide', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#slide-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Slides</h1>
<a class="add-button" href="create" title="Add new">Add new</a>
<?php $pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);?>
<div style="clear: both;"></div>
<div class="md-card">
    <div class="md-card-content">
        <ul class="list-slide">
            <div class="list">
                <?php $list = Slide::model()->findAll(array(
                            'order' => 'position ASC',
                        ));
                    $i = 0;    
                    if(count($list) > 0){
                        
                        foreach($list as $value){
                            $i++;
                            $image = SimpleImage::model()->getThumbnail($value['image'],150);
                            ?>
                            <li class="slide-item" data-id="<?php echo $value['id']?>">
                                <div class="image" style="background-image:url('<?php echo $image?>') ;"></div>
                                <p class="title"><?php echo $value['title']?></p>
                            </li>
                        <?php }
                    }
                ?>
            </div>
            <li class="add">
                <div class="image">
                    <i class="material-icons">add</i>
                </div>
                <p class="title">Add slide</p>
            </li>
        </ul>
    </div>
</div>

<div class="md-card">
    <div class="md-card-toolbar">
        <div class="md-card-toolbar-actions">
            <i class="md-icon material-icons md-card-toggle"></i>
        </div>
		<h3 class="md-card-toolbar-heading-text">Thuộc tính</h3>
    </div>
    <div class="md-card-content" id="attribute-slide">
        <?php $form=$this->beginWidget('CActiveForm', array(
        	'id'=>'slide-form',
        	// Please note: When you enable ajax validation, make sure the corresponding
        	// controller action is handling ajax validation correctly.
        	// There is a call to performAjaxValidation() commented in generated controller code.
        	// See class documentation of CActiveForm for details on this.
        	'enableAjaxValidation'=>false,
        )); ?>
            <?php echo CHtml::hiddenField('action','add');?>
            <?php echo CHtml::hiddenField('id',($model->id != null) ? $model->id : 0);?>
        	<?php echo $form->errorSummary($model); ?>
            <div class="uk-grid">
                <div class="uk-width-1-4">
                    <div class="row">
                        <?php echo $form->labelEx($model,'image'); ?>
                    	<?php 
                        $img_src = '';
                        $img_name = '';
                        if($model->image != ''){
                            $img_src = SimpleImage::model()->getOriginalImage($model->image);
                            $img_name = $model->image;
                        }?>
                        <ul class="image-upload" style="text-align: left;">
                           <li class="item-upload relative">
                              <i class="fa fa-picture-o"></i>
                              <input type="file" class="general-input" stt="1" id="general-input-1" multiple="true" value="<?php echo $img_name?>" <?php echo ($img_name !='') ? 'disabled="disabled"' : '' ?> />
                              <?php echo $form->hiddenField($model,'image',array(
                                 'class' => 'hidden-input',
                              ))?>
                              <div id="preview" class="absolute preview" style="<?php echo ($img_src !='') ? 'background-image:url('.$img_src.')' :''?>">
                              </div>
                              <?php if($img_src != '') echo '<i class="fa fa-times-circle"></i>'?>            
                           </li>
                        </ul>
                    </div>
                    <div class="buttons">
                		<span class="md-btn md-btn-success" id="btn-save">Save</span>
                	</div>
                </div>
                <div class="uk-width-3-4">
                    <div class="row">
                    	<?php echo $form->labelEx($model,'title'); ?>
                    	<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
                    	<?php echo $form->error($model,'title'); ?>
                    </div>
                        
                
                    <div class="row">
                    	<?php echo $form->labelEx($model,'link'); ?>
                    	<?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>255)); ?>
                    	<?php echo $form->error($model,'link'); ?>
                    </div>
                    
                    <div class="row">
                        <?php $model->position = $i+1;?>
                    	<?php echo $form->labelEx($model,'position'); ?>
                    	<?php echo $form->numberField($model,'position'); ?>
                    	<?php echo $form->error($model,'position'); ?>
                    </div>
                    
                    <div class="uk-margin-bottom">
                    	<div class="checkbox checkbox-slider-md checkbox-slider--b-flat">
                            <label>
                                <?php echo $form->checkBox($model,'status',array('checked' => true));?>
                                <span>Hiển thị</span>
                            </label>
                        </div>
                		<?php echo $form->error($model,'status'); ?>
                    </div>
                    
                    
                	
                </div>
                
            </div>
            
        
        <?php $this->endWidget(); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl?>/js/ajaxupload.js"></script>
<script>
    $(function(){
        $(".general-input").ajaxupload({
            urlUpload:'/admin/default/uploadimage'
        });
        $(document).on("click",".fa-times-circle", function(){
            $this = $(this);
            $this.parents(".item-upload").find("div.preview").css("background-image","none");
            $this.parents(".item-upload").find(".general-input").val('');       
            $this.parents(".item-upload").find(".hidden-input").val('');
            $this.parents(".item-upload").find(".general-input").prop("disabled",false);  
            $this.remove();
        });
        
        $("#btn-save").click(function(){
            var data = $("#slide-form").serialize();
            
            if($("#Slide_image").val() != ''){
                $(".list-slide .list").fadeOut();
                var succ = function(data){
                    $(".list-slide .list").html(data);
                    $(".list-slide .list").fadeIn();
                };
                handleAjax('/admin/slide/create','POST','',data,succ);
            }else{
                alert('Bạn phải chọn 1 ảnh cho slide');
            }
        });
        
        $(".add").click(function(){
            $("#slide-form").trigger("reset");
            $("#action").val('add');
        });
        $(document).on('click','.slide-item',function(e){
            e.preventDefault();
            var $this = $(this);
            var id = $this.attr('data-id');
            $("#id").val(id);
            var succ = function(data){
                $("#Slide_title").val(data.title);
                $("#Slide_link").val(data.link);
                $("#Slide_position").val(data.position);
                $("#Slide_status").attr('checked',data.checked);
                $("#Slide_image").val(data.image)
                $("#preview").css("background-image","url("+data.image_src+")");
            }
            
            $("#action").val('update');
            if($("#attribute-slide").css('display') == 'none'){
                $(".md-card-toggle").click(); 
            }
            
            handleAjax('/admin/slide/view','POST','json',{'id':id},succ);
        });
    });
</script>
