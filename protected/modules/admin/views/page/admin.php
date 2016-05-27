<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Page', 'url'=>array('index')),
	array('label'=>'Create Page', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#page-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Pages</h1>
<a class="add-button" href="create" title="Add new">Add new</a>
<?php $pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'page-grid',
	'dataProvider'=>$model->search(),
    'summaryText' =>'<span>Số dòng:</span>'.CHtml::dropDownList('pageSize',$pageSize,Yii::app()->params['pageSizes'],array('onchange'=>"$.fn.yiiGridView.update('".$this->id."-grid',{ data:{pageSize: $(this).val() }})",'class' => 'pagesize')).'{start} - {end} of {count}' ,
	'filter'=>$model,
	'columns'=>array(
        array(
            'name' => 'name',
            'headerHtmlOptions' => array('style' => 'width:250px;text-align:left'),
        ),
        array(
            'name' => 'slug',
            'headerHtmlOptions' => array('style' => 'width:250px;text-align:left'),
        ),
        array(
            'name' => 'status',
            'value' => array($this,'gridStatus'),
            'type' => 'raw',
            'filter' => CHtml::dropDownList('Page[status]',$model->status,Page::model()->list_status,array('empty' => '--Tất cả--','style' =>'')),
            'headerHtmlOptions' => array('style' => 'width:160px;text-align:left'),
        ),
        array(
            'name' => 'create_date',
            'header' => '<a>Ngày</a>',
            'value' => array($this,'gridDate'),
            'type' => 'raw',
            'filter' => false,
            'headerHtmlOptions' => array('style' => 'text-align:left'),
        ),
		array(
			'class'=>'CButtonColumn',
            'template' => '{update}'
		),
	),
)); ?>
