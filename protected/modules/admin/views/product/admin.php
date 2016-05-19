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

<h1>Manage Products</h1>
<a class="add-button" href="create" title="Add new">Add new</a>
<?php $pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-grid',
	'dataProvider'=>$model->search(),
    'summaryText' =>'<span>Số dòng:</span>'.CHtml::dropDownList('pageSize',$pageSize,Yii::app()->params['pageSizes'],array('onchange'=>"$.fn.yiiGridView.update('".$this->id."-grid',{ data:{pageSize: $(this).val() }})",'class' => 'pagesize')).'{start} - {end} of {count}' ,
	'filter'=>$model,
	'columns'=>array(
		array(
            'name' => 'id',
            'htmlOptions' => array('style' => 'width:60px;text-align:center'),
        ),
		'title',
		'image',
		'sku',
		'price',
		'create_date',
		/*
		'modify_date',
		'create_by',
		'modify_by',
		'feature',
		'description',
		array(
            'name' => 'status',
            'value' => '($data->status== 0) ? "No" : "Yes"', 
            'filter' => CHtml::dropDownList('Product[status]',$model->status,array(
                    'No','Yes'
                ),
                array(
                    'empty' => '-- All --',
                    'style' => 'width:70px',
                )
         )),
		'stock',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
