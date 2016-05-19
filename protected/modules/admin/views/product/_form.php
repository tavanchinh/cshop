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
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
    <div class="uk-grid">
        <div class="uk-width-3-4">
            <div class="md-card">
                <div class="md-card-content">
                    <div class="row">
                    	<?php echo $form->labelEx($model,'title'); ?>
                    	<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
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
                    <?php echo $form->textArea($model,'sapo',array('rows'=>3, 'cols'=>50)); ?>
            		<?php echo $form->error($model,'sapo'); ?>
                </div>
            </div>
        </div>
        <div class="uk-width-1-4">
            <div class="md-card">
                <div class="md-card-toolbar">
                    <div class="md-card-toolbar-actions">
                        <i class="md-icon material-icons md-card-toggle"></i>
                    </div>
            		<h3 class="md-card-toolbar-heading-text">Danh mục</h3>
                </div>
                <div class="md-card-content">
                    <?php $list_cate = Category::model()->getMultilevel();
                    if(count($list_cate) > 0){?>
                        <ul class="checklist">
                            <?php foreach($list_cate as $value){?>
                                <li>
                                    <label>
                                        <input type="checkbox" name="categories[]" value="<?php echo $value['id']?>" />
                                        <?php echo $value['name']?>
                                    </label>
                                    <?php if(isset($value['sub'])){?>
                                    <ul class="children">
                                        <?php foreach($value['sub'] as $sub){?>
                                            <li>
                                                <label>
                                                    <input type="checkbox" name="categories[]" value="<?php echo $sub['id']?>" />
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
            		<h3 class="md-card-toolbar-heading-text">Tags</h3>
                </div>
                <div class="md-card-content">
                    <div class="column">
                          <?php 
                             $str_tag_id = '';
                             $list_tag = array();
                             if($model->id != null){
                                $sql = "SELECT id,name from tag a INNER JOIN product_tag b ON a.id = b.tag_id WHERE film_id =".$model->id;
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
            
        </div>
    </div>
    
	<?php echo $form->errorSummary($model); ?>
    
    
        

    <div class="row">
    	<?php echo $form->labelEx($model,'image'); ?>
    	<?php echo $form->textField($model,'image',array('size'=>60,'maxlength'=>255)); ?>
    	<?php echo $form->error($model,'image'); ?>
    </div>
    

    <div class="row">
    	<?php echo $form->labelEx($model,'feature'); ?>
    	<?php echo $form->textField($model,'feature'); ?>
    	<?php echo $form->error($model,'feature'); ?>
    </div>
        

    
    <script>
        $(function(){
            CKEDITOR.replace('Product_description',{
                width:'100%',
            });
            CKEDITOR.replace('Product_sapo',{
                width:'100%',
                height:'100px'
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
        })
    </script>
        

    <div class="row">
    	<?php echo $form->labelEx($model,'status'); ?>
    	<?php echo $form->textField($model,'status'); ?>
    	<?php echo $form->error($model,'status'); ?>
    </div>
        

    <div class="row">
    	<?php echo $form->labelEx($model,'stock'); ?>
    	<?php echo $form->textField($model,'stock'); ?>
    	<?php echo $form->error($model,'stock'); ?>
    </div>
        

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
