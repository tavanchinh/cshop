<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<div class="clearfix"></div>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    <div class="uk-grid">
        <div class="uk-width-3-4">
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-form-row">
                    	<?php echo $form->labelEx($model,'title'); ?>
                    	<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
                    	<?php echo $form->error($model,'title'); ?>
                    </div>
                    <div class="uk-form-row">
                        <?php 
                        $list_cat = CHtml::listData(Category::model()->findAll(),'id','name');
                        $str_news_cat_id = '';
                        if($model->id != null){
                            $cate_selected = NewsCategory::model()->findAllByAttributes(array(
                                'news_id' => $model->id,
                            ));
                        
                            if(count($cate_selected) > 0){
                                foreach($cate_selected as $value){
                                   $str_news_cat_id .= $value->cat_id .',';
                                }
                                $str_news_cat_id = substr($str_news_cat_id,0,-1);
                            }
                        }
                        ?>
                        <?php echo $form->labelEx($model,'cat_id'); ?>
                        <?php echo CHtml::dropDownList('News[categories]','',$list_cat,array(
                            'multiple' => 'multiple',
                            'style' => 'width:100%'
                        ));?>
                        <?php echo $form->error($model,'cat_id'); ?>
                    </div>
                    <div class="uk-grid uk-form-row">
                        <div class="uk-width-1-3">
                            <?php echo $form->labelEx($model,'avatar'); ?>
                   		
                            <?php 
                            $img_src = '';
                            $img_name = '';
                            if($model->avatar != ''){
                                $img_src = SimpleImage::model()->getOriginalImage($model->avatar);
                                $img_name = $model->avatar;
                            }?>
                            <ul>
                                <li class="item-upload relative">
                                    <i class="fa-times-circle"></i>  
                                    <input type="file" class="general-input" stt="1" id="general-input-1" multiple="true" value="<?php echo $img_name?>" <?php echo ($img_name !='') ? 'disabled="disabled"' : '' ?> />
                                    <?php echo $form->hiddenField($model,'avatar',array(
                                     'class' => 'hidden-input',
                                    ))?>
                                    <div class="absolute preview" style="<?php echo ($img_src !='') ? 'background-image:url('.$img_src.')' :''?>">
                                    </div>
                                    <?php if($img_src != '') echo '<i class="fa fa-times-circle"></i>'?>            
                                </li>
                            </ul>
                            <?php echo $form->error($model,'avatar'); ?>
                            
                            
                         </div>
                        <div class="uk-width-2-3">
                        	<?php echo $form->labelEx($model,'sapo'); ?>
                        	<?php echo $form->textArea($model,'sapo',array('style' =>'resize:none;width:100%;padding:5px;height:150px')); ?>
                        	<?php echo $form->error($model,'sapo'); ?>
                            
                        </div>
                    </div>
                    <div class="uk-form-row">
                		<?php echo $form->labelEx($model,'content'); ?>
                		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
                		<?php echo $form->error($model,'content'); ?>
                        <script>
                            $(function(){
                                CKEDITOR.replace('News_content',{
                                    width:'100%',
                                });
                            })
                        </script>
                	</div>
                    
                    
                    <div class="uk-form-row">
                        <?php 
                        $str_tag_id = '';
                        $list_tag = array();
                        if($model->id != null){
                        $sql = "SELECT id,name from tag a INNER JOIN news_tag b ON a.id = b.tag_id WHERE news_id =".$model->id;
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
                        <?php echo CHtml::label('Tags','News_tags')?>
                        <?php echo CHtml::hiddenField('News[tags]','',array(
                            'style' => 'width:100%'
                        ));?>
                   </div>
                </div>
            </div>
            
        </div>
        <div class="uk-width-1-4">
            <div class="md-card">
                <div class="md-card-content">
                    
                    
                    <div class="uk-form-row">
                    	<?php echo $form->labelEx($model,'publish_date'); ?>
                    	<?php echo $form->textField($model,'publish_date',array('class' => 'datetimepicker')); ?>
                    	<?php echo $form->error($model,'publish_date'); ?>
                    </div>
                    
                    <div class="uk-form-row">
                    	<?php echo $form->labelEx($model,'status'); ?>
                    	<?php echo $form->dropDownList($model,'status',News::model()->list_status); ?>
                    	<?php echo $form->error($model,'status'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
        

    <div class="md-fab-wrapper">
        <a class="md-fab md-fab-primary" href="javascript:void(0)" onclick="$('#news-form').submit();">
            <i class="material-icons"><?php echo ($model->isNewRecord) ? 'create' : 'save'; ?></i>
        </a>
    </div>

<?php $this->endWidget(); ?>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl?>/js/ajaxupload.js"></script>
<script>
   $(document).ready(function(){
      $('.datetimepicker').datetimepicker({      	
         format:'d/m/Y H:i:s',
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
      })
      
      
      $("#News_categories").val([<?php echo $str_news_cat_id?>]).select2({
         lang:'vi',
         allowClear: true,
      });
      
      
      
      /*---- Select2 Tags -----*/
      var def_arr_tag = <?php echo json_encode($list_tag)?>;      
      $("#News_tags").val([<?php echo $str_tag_id?>]).select2({
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
   });
   
   $(document).on("keypress", 'form', function ( e ) {
      var code = e.keyCode || e.which;
      if (code == 13) {
        e.preventDefault();
        return false;
      }
   });
</script>
