<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Product', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#product-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php 
    $tree_cate = Category::model()->getTree(Category::model()->getAll());
    unset($tree_cate[0]);
?>
<h1>Manage Products</h1>
<a class="add-button" href="create" title="Add new">Add new</a>
<ul class="subsubsub">  
    <?php foreach($list_count_by_status as $value){?>
        <li><a <?php echo ($value['mode'] == $view_mode) ? 'class="active"' : ''?> href="/admin/product/admin?view=<?php echo $value['mode']?>"><?php echo $value['text']?> (<?php echo $value['count']?>)</a></li>    
    <?php }?>
    
</ul>
<?php $pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-grid',
	'dataProvider'=>$model->search(),
    'summaryText' =>'<span>Số dòng:</span>'.CHtml::dropDownList('pageSize',$pageSize,Yii::app()->params['pageSizes'],array('onchange'=>"$.fn.yiiGridView.update('".$this->id."-grid',{ data:{pageSize: $(this).val() }})",'class' => 'pagesize')).'{start} - {end} of {count}' ,
	'filter'=>$model,
	'columns'=>array(
		array(
            'name' => 'id',
            'headerHtmlOptions' => array('style' => 'width:60px'),
            //'htmlOptions' => array('style' => 'width:60px;text-align:center'),
        ),
        array(
            'name' => 'image',
            'value' => array($this,'gridImage'),
            'headerHtmlOptions' => array('style' => 'width:70px;text-align:center'),
            'type' =>'raw',
            'filter' => false,
        ),
        array(
            'name' => 'title',
            'value' => array($this,'gridTitle'),
            'headerHtmlOptions' => array('style' => 'font-weight:bold'),
            'type' =>'raw',
        ),
        array(
            'name' => 'sku',
            'headerHtmlOptions' => array('style' => 'width:100px'),
            
        ),
        array(
            'name' => 'price',
            'headerHtmlOptions' => array('style' => 'width:100px'),
            'value' => 'Str::formatNumber($data->price).\' \'.Product::model()->currency',
        ),
        array(
            'name' => 'stock',
            'value' => array($this,'gridStock'),
            'type' =>'raw',
            'headerHtmlOptions' => array('style' => 'width:100px'),
            'filter' => CHtml::dropDownList('Product[stock]',$model->stock,Product::model()->list_stock,
                array(
                    'empty' => '-- Tất cả --',
                )
            )
        ),
        array(
            'header' => '<a>Danh mục</a>',
            'name' => 'categories',
            'value' => array($this,'gridCategories'),
            'headerHtmlOptions' => array('style' => 'width:130px'),
            'filter' => CHtml::dropDownList('Product[cat_id]',$model->cat_id,$tree_cate,array('empty'=>'-- Tất cả --')),
            'type' =>'raw',
        ),
        array(
            'name' => 'create_date',
            'value' => array($this,'gridDate'),
            'headerHtmlOptions' => array('style' => 'width:150px'),
            'type' =>'raw',
        ),
        array(
            'name' => 'feature',
            'value' => array($this,'gridFeature'),
            'headerHtmlOptions' => array('style' => 'width:50px'),
            'type' => 'raw',
        ),
		/*
		'modify_date',
		'create_by',
		'modify_by',
		'feature',
		'description',
		
		
		*/
		
	),
)); ?>
