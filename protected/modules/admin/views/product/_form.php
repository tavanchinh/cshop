<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div style="clear: both;">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); 
echo CHtml::hiddenField('continue',0);

?>

	<p class="note">Những trường đánh dấu <span class="required">*</span> không được để trống.</p>
    <?php echo $form->errorSummary($model); ?>
    <div class="uk-grid">
        <div class="uk-width-3-4">
            <div class="md-card">
                <div class="md-card-content">
                    <div class="row">
                    	<?php echo $form->labelEx($model,'title'); ?>
                    	<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'placeholder' => 'Nhập tên sản phẩm')); ?>
                    	<?php echo $form->error($model,'title'); ?>
                    </div>
                </div>
            </div>
            
            <div class="md-card">
                <div class="md-card-toolbar">
            		<h3 class="md-card-toolbar-heading-text"><?php echo $form->labelEx($model,'description'); ?></h3>
                </div>
                <div class="md-card-content">
                    <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
            		<?php echo $form->error($model,'description'); ?>
                </div>
            </div>
            
            <div class="md-card">
                <div class="md-card-toolbar">
                    <div class="md-card-toolbar-actions">
                        <i class="md-icon material-icons md-card-toggle"></i>
                    </div>
            		<h3 class="md-card-toolbar-heading-text">Thuộc tính</h3>
                </div>
                <div class="md-card-content">
                    <div id="product-option">
                        <div class="row">
                        	<?php echo $form->labelEx($model,'sku'); ?>
                        	<?php echo $form->textField($model,'sku',array('size'=>60,'maxlength'=>255)); ?>
                        	<?php echo $form->error($model,'sku'); ?>
                        </div>
                            
                        <div class="row">
                        	<?php echo $form->labelEx($model,'price'); ?>
                        	<?php echo $form->textField($model,'price',array('placeholder' => 'đ')); ?>
                        	<?php echo $form->error($model,'price'); ?>
                        </div>
                        
                        <div class="row">
                        	<?php echo $form->labelEx($model,'sale'); ?>
                        	<?php echo $form->textField($model,'sale',array('placeholder' => '%')); ?>
                        	<?php echo $form->error($model,'sale'); ?>
                        </div>
                        <?php $options = Product::model()->decodeOptions($model->custom_field);
                        if($options !== null && is_array($options) && count($options) > 0){
                            $i = 0;
                            foreach($options as $opt){
                                $i++;
                                ?>
                                <div class="row" id="option-<?php echo $i?>">
                                    <label><?php echo $opt['label']?></label>
                                    <input style="float: left;" type="text" name="Product[options][value][]" value="<?php echo $opt['value']?>" />
                                    <a class="btn-remove-option" onclick="delete_option(<?php echo $i?>)" style="float: left;padding:10px" href="javascript:void(0)"><i class="material-icons uk-text-primary"></i></a>
                                </div>
                            <?php }
                        }
                        ?>
                    </div>
                    <div class="uk-text-right">
                        <span class="md-btn md-btn-success" id="btn-add-option">Thêm thuộc tính</span>
                    </div>    
                    
                    
                </div>
                
            </div>
            
            <div class="md-card">
                <div class="md-card-toolbar">
                    <div class="md-card-toolbar-actions">
                        <i class="md-icon material-icons md-card-toggle"></i>
                    </div>
            		<h3 class="md-card-toolbar-heading-text"><?php echo $form->labelEx($model,'sapo'); ?></h3>
                </div>
                <div class="md-card-content">
                    <?php echo $form->textArea($model,'sapo',array('rows'=>2, 'cols'=>50,'class' => 'md-input')); ?>
            		<?php echo $form->error($model,'sapo'); ?>
                </div>
            </div>
            
            <div class="md-card">
                <div class="md-card-toolbar">
                    <div class="md-card-toolbar-actions">
                        <i class="md-icon material-icons md-card-toggle"></i>
                    </div>
            		<h3 class="md-card-toolbar-heading-text">Tags</h3>
                </div>
                <div class="md-card-content">
                    <?php 
                    $str_tag_id = '';
                    $list_tag = array();
                    if($model->id != null){
                    $sql = "SELECT a.id,name from tag a INNER JOIN product_tag b ON a.id = b.tag_id WHERE product_id =".$model->id;
                    $tag_selected = Yii::app()->db->createCommand($sql)->queryAll();
                    if(count($tag_selected) > 0){
                       foreach($tag_selected as $value){
                          $str_tag_id .= $value['id'].',';
                          $tmp['id'] = $value['id'];
                          $tmp['text'] = $value['name'];
                          $list_tag[] = $tmp;
                       }
                       $str_tag_id = substr($str_tag_id,0,-1);
                    }
                    }
                    ?>
                    <?php echo CHtml::hiddenField('tags','',array(
                    'style' => 'width:auto'
                    ));?>
                </div>
            </div>
        </div>
        <div class="uk-width-1-4">
            <div class="md-card">
                <div class="md-card-content">
                    <span onclick="$('#product-form').submit();" class="save md-btn md-btn-primary">Lưu</span>
                    <span onclick="$('#continue').val(1);$('#product-form').submit();" class="save-contiue md-btn md-btn-success">Lưu, tiếp tục</span>
                </div>
            </div>
            <div class="md-card">
                <div class="md-card-toolbar">
                    <div class="md-card-toolbar-actions">
                        <i class="md-icon material-icons md-card-toggle"></i>
                    </div>
            		<h3 class="md-card-toolbar-heading-text">Options</h3>
                </div>
                <div class="md-card-content">
                    <ul class="checklist">
                        <li>
                            <?php echo $form->checkBox($model,'feature'); ?>
                            <?php echo $form->labelEx($model,'feature'); ?>
                        </li>
                    </ul>
                    <div class="row" style="margin-bottom:0;">
                        <?php echo $form->labelEx($model,'status'); ?>
                    	<?php echo $form->dropDownList($model,'status',Product::model()->list_status,array('placeholder' => '%')); ?>
                    	<?php echo $form->error($model,'status'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->labelEx($model,'stock'); ?>
                    	<?php echo $form->dropDownList($model,'stock',Product::model()->list_stock,array('placeholder' => '%')); ?>
                    	<?php echo $form->error($model,'stock'); ?>
                    </div>
                    
                </div>
            </div>
            <div class="md-card">
                <div class="md-card-toolbar">
                    <div class="md-card-toolbar-actions">
                        <i class="md-icon material-icons md-card-toggle"></i>
                    </div>
            		<h3 class="md-card-toolbar-heading-text">Danh mục</h3>
                </div>
                <div class="md-card-content">
                    <?php 
                    $list_cate = Category::model()->getMultilevel();
                    
                    if($model->id != null){
                        $list_cate_selected = Product::model()->getCatIDSelected($model->id);    
                    }else{
                        $list_cate_selected = array();
                    }
                    
                    
                    
                    if(count($list_cate) > 0){?>
                        <ul class="checklist">
                            <?php foreach($list_cate as $value){?>
                                <li>
                                    <label>
                                        <input type="checkbox" name="categories[]" <?php echo (in_array($value['id'],$list_cate_selected)) ? 'checked' : ''?> value="<?php echo $value['id']?>" />
                                        <?php echo $value['name']?>
                                    </label>
                                    <?php if(isset($value['sub'])){?>
                                    <ul class="children">
                                        <?php foreach($value['sub'] as $sub){?>
                                            <li>
                                                <label>
                                                    <input type="checkbox" name="categories[]" <?php echo (in_array($sub['id'],$list_cate_selected)) ? 'checked' : ''?> value="<?php echo $sub['id']?>" />
                                                    <?php echo $sub['name']?>
                                                </label>
                                            </li>
                                        <?php }?>
                                    </ul>
                                    <?php }?>
                                </li>
                            <?php }?>
                        </ul>
                    <?php }
                    ?>
                </div>
            </div>
            
            <div class="md-card">
                <div class="md-card-toolbar">
                    <div class="md-card-toolbar-actions">
                        <i class="md-icon material-icons md-card-toggle"></i>
                    </div>
            		<h3 class="md-card-toolbar-heading-text"><?php echo $form->labelEx($model,'image'); ?></h3>
                </div>
                <div class="md-card-content">
                    <?php 
                    $img_src = '';
                    $img_name = '';
                    if($model->image != ''){
                        $img_src = SimpleImage::model()->getOriginalImage($model->image);
                        $img_name = $model->image;
                    }?>
                    <ul class="image-upload">
                       <li class="item-upload relative">
                          <i class="fa fa-picture-o"></i>
                          <input type="file" class="general-input" stt="1" id="general-input-1" multiple="true" value="<?php echo $img_name?>" <?php echo ($img_name !='') ? 'disabled="disabled"' : '' ?> />
                          <?php echo $form->hiddenField($model,'image',array(
                             'class' => 'hidden-input',
                          ))?>
                          <div class="absolute preview" style="<?php echo ($img_src !='') ? 'background-image:url('.$img_src.')' :''?>">
                          </div>
                          <?php if($img_src != '') echo '<i class="fa fa-times-circle"></i>'?>            
                       </li>
                    </ul>
                </div>
            </div>
            <div class="md-card">
                <div class="md-card-toolbar">
                    <div class="md-card-toolbar-actions">
                        <i class="md-icon material-icons md-card-toggle"></i>
                    </div>
            		<h3 class="md-card-toolbar-heading-text">Bộ sưu tập</h3>
                </div>
                <div class="md-card-content">
                    <?php 
                    $list_image = array();
                    if($model->id != null){
                        $sql = "SELECT * FROM product_gallery WHERE product_id =".$model->id;
                        $product_image = Yii::app()->db->createCommand($sql)->queryAll();
                        if(count($product_image) > 0){
                            foreach($product_image as $value){
                                $tmp['name'] = $value['image'];
                                SimpleImage::model()->getOriginalImage($value['image']);
                                $list_image[] = $tmp;
                            }
                        }
                    }
                    ?>
                    <ul class="image-upload-gallery">
                    <?php for($i =0; $i <=5; $i++){
                            $img_name = '';
                            $img_src = '';
                            if(isset($list_image[$i])){
                                //CVarDumper::dump($list_image,10,true);die;
                                $img_name = $list_image[$i]['name'];
                                $img_src = SimpleImage::model()->getOriginalImage($img_name);
                            }
                        
                        ?>
                        <li class="item-upload relative">
                        <i class="fa fa-picture-o"></i>
                        <input type="file" class="general-input" stt="<?php echo $i?>" id="general-input-<?php echo $i?>" multiple="true" value="<?php echo $img_name?>" <?php echo ($img_name !='') ? 'disabled="disabled"' : '' ?> />
                        <input type="hidden" class="hidden-input" name="product_image[]" id="product_image_<?php echo $i?>" value="<?php echo $img_name?>" />
                        <div class="absolute preview" style="<?php echo ($img_src !='') ? 'background-image:url('.$img_src.')' :''?>">
                            <?php if($img_src != '') echo '<i class="fa fa-times-circle"></i>'?>
                        </div>
                        </li>
                    <?php }?>
                    
                    </ul>
                </div>
            </div>
            
            <div class="md-card">
                <div class="md-card-content">
                    <span onclick="$('#product-form').submit();" class="save md-btn md-btn-primary">Lưu</span>
                    <span onclick="$('#continue').val(1);$('#product-form').submit();" class="save-contiue md-btn md-btn-success">Lưu, tiếp tục</span>
                </div>
            </div>
        </div>
    </div>
    


<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl?>/js/ajaxupload.js"></script>
<script>
    $(function(){
        CKEDITOR.replace('Product_description',{
            width:'100%',
        });
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
        /*---- Select2 Tags -----*/
        var def_arr_tag = <?php echo json_encode($list_tag)?>;      
        $("#tags").val([<?php echo $str_tag_id?>]).select2({
            lang:'vi',
            multiple: true,
            placeholder: "Nhập tên tags",
            tokenSeparators: [','],
            createSearchChoice: function (term, data) {
            return { id: '_TEMP_', text: term + ' (new tag)', isTemp: true };
            },
            createSearchChoicePosition: 'bottom',
            minlength:1,
            ajax:{
            url: "/admin/tag/autocomplete",
            dataType: "json",
            type: "POST",
            data: function (term, page) {
               return {
                  term: term,
               };
            },
            results: function (data, page) {
               //lastResults = data.results;
               var arr = new Array();
               $(data).each(function (i, items) {
                 arr.push({
                     text: items.label,
                     id: items.id
                 });
               });
               return {
                 results: arr
               };
            }
            },
            initSelection: function (element, callback) {
                var data = def_arr_tag
                callback(data);
            },
        }).on('select2-selecting', function (e) {
            var $select = $(this),
            item = e.choice;
            if (item.isTemp) {
                e.preventDefault();
                var dataPost = {
                    "term": $.trim(item.text.replace(' (new tag)', '')),
                };
            $.ajax({
               type: "POST",
               async: false,
               url: "/admin/tag/quickadd",
               data: dataPost,
               dataType: 'json',
               cache: false,
               success: function (done) {
                  console.log(done.id);
                  var data = $select.select2('data');
                  data.push({
                     id: done.id,
                     text: done.label + ' (new tag)'
                  });
                  $select.select2('data', data);                    
               },
               complete: function () {
               $select.select2('close');
               }
            });
            }
        });
        
        /*---- End select2 tag ----*/
        
        $("#btn-add-option").click(function(){
            var html = '<div class="row">\
                            <div style="width:100px;margin:0 20px 0 0" class="uk-float-left"><input style="max-width:100%;font-weight:bold" placeholder="Tiêu đề" type="text" name="Product[options][label][]"></div>\
                            <input placeholder="Giá trị" type="text" name="Product[options][value][]">\
                        </div>';
            $("#product-option").append(html);
                        
        })
    });
    function delete_option(i){
        var conf = confirm("Bạn có chắc chắn muốn xóa thuộc tính này ?");
        if(conf){
            $("#option-"+i).remove();
        }
    }
    
</script>

