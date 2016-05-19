<?php
/* @var $this MembergroupController */
/* @var $model Membergroup */

$this->breadcrumbs=array(
	'Membergroups'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Membergroup', 'url'=>array('index')),
	array('label'=>'Create Membergroup', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#membergroup-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Membergroups</h1>

<?php echo CHtml::link('Thêm mới',Yii::app()->request->baseUrl.'/admin/'.$this->id.'/create',array('class'=>'add-button')); ?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'membergroup-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'group_name',
		'status',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
