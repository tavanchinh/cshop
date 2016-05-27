<?php
/* @var $this MenuController */
/* @var $model Menu */

$this->breadcrumbs=array(
	'Menus'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Menu', 'url'=>array('index')),
	array('label'=>'Create Menu', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#menu-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Menus</h1>
<div style="clear: both;"></div>
<div class="uk-grid">
    <div class="uk-width-1-3">
        <div class="md-card">
            <div class="md-card-toolbar">
                <div class="md-card-toolbar-actions">
                    <i class="md-icon material-icons md-card-toggle"></i>
                </div>
        		<h3 class="md-card-toolbar-heading-text">Danh mục sản phẩm</h3>
            </div>
            <div class="md-card-content">
                <?php 
                $list_cate = Category::model()->getMultilevel();
                
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
                <?php }?>
                <div class="uk-text-right">
                    <span class="btn-add-menu md-btn md-btn-small md-btn-success">Add to menu</span>
                </div>                
            </div>
        </div>
        
        <div class="md-card">
            <div class="md-card-toolbar">
                <div class="md-card-toolbar-actions">
                    <i class="md-icon material-icons md-card-toggle"></i>
                </div>
        		<h3 class="md-card-toolbar-heading-text">Page</h3>
            </div>
            <div class="md-card-content">
                <?php 
                $list_page = Page::model()->getListSimple();
                
                if(count($list_page) > 0){?>
                    <ul class="checklist">
                        <?php foreach($list_page as $key=>$value){
                            //var_dump($value);die;
                            ?>
                            <li>
                                <label>
                                    <input type="checkbox" name="categories[]" value="<?php echo $key?>" />
                                    <?php echo $value?>
                                </label>
                            </li>
                        <?php }?>
                    </ul>
                <?php }
                ?>
                <div class="uk-text-right">
                    <span class="btn-add-menu md-btn md-btn-small md-btn-success">Add to menu</span>
                </div>
            </div>
        </div>
        
    </div>
    <div class="uk-width-2-3">
        <div class="md-card">
            <div class="md-card-toolbar">
                <div class="md-card-toolbar-actions">
                    <span title="Lưu" id="btn-save-menu"><i class="material-icons md-icon">save</i></span>
                </div>
        		<h3 class="md-card-toolbar-heading-text">Menu</h3>
            </div>
            <div class="md-card-content" id="menu-structure">
                <div class="loading hide">
                    <div class="md-preloader"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="48" width="48" viewBox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="4"></circle></svg></div>
                </div>
                <?php $all = Menu::model()->getMultilevel();
                
                //CVarDumper::dump($all,10,true);die;
                ?>
                <?php if(count($all) > 0){?>
                    <div class="dd">
                        <ol class="dd-list">
                            <?php foreach($all as $value){?>
                                <li class="dd-item" data-id="<?php echo $value['id']?>">
                                    <span class="uk-float-right btn-delete-menu" title="Xóa" data-id="<?php echo $value['id']?>"><i class="material-icons">delete</i></span>
                                    <div class="dd-handle"><?php echo $value['title']?></div>
                                    <?php if(isset($value['sub'])){?>
                                        <ol class="dd-list">
                                        <?php $list_sub = $value['sub'];?>
                                        
                                        <?php foreach($list_sub as $sub){?>
                                            <li class="dd-item" data-id="<?php echo $sub['id']?>"">
                                                <span class="uk-float-right btn-delete-menu" title="Xóa" data-id="<?php echo $sub['id']?>"><i class="material-icons">delete</i></span>
                                                <div class="dd-handle"><?php echo $sub['title']?></div>
                                            </li>
                                        <?php }?>
                                        </ol>
                                    <?php }?> 
                                </li>
                            <?php }?>
                            
                        </ol>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo Yii::app()->request->baseUrl?>/js/jquery.nestable.js"></script>
<script>
    $(document).ready(function () {
        
        var structure = [];
        
        
        $(".dd").nestable({
            maxDepth:2,
        }).on('change',function(e){
            var data = $('.dd').nestable('serialize');
            structure = window.JSON.stringify(data);
        });
        
        $("#btn-save-menu").click(function(){
            
            if(structure.length > 0){
                $("#menu-structure .loading").removeClass('hide');
                var succ = function(data){
                    $("#menu-structure .loading").addClass('hide');
                    structure = [];
                }
                handleAjax('/admin/menu/update','POST','',{'structure':structure},succ);
            }
        });
        
        $(".btn-delete-menu").click(function(){
            $this = $(this);
            var id = $this.attr('data-id');
            var conf = confirm("Bạn có chắc chắn muốn xóa menu này ?");
            if(conf){
                var succ = function(data){
                    $this.parent().remove();
                }
                handleAjax('/admin/menu/remove','POST','',{'id':id},succ);
            }
        })
        
        
    });
</script>
