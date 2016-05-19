<?php
/* @var $this WebconfigController */
/* @var $model WebConfig */

$this->breadcrumbs=array(
	'Web Configs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List WebConfig', 'url'=>array('index')),
	array('label'=>'Create WebConfig', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#web-config-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Cấu hình website</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'web-config-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'web_title',
		'meta_description',
		'meta_keyword',
      array(
			'class'=>'CButtonColumn',
         'template' => '{view}{update}',
         'htmlOptions' => array('style' => 'width:90px;text-align: center;')
		),
	),
)); ?>
