<?php
/* @var $this MembergroupController */
/* @var $model Membergroup */

$this->breadcrumbs=array(
	'Membergroups'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Membergroup', 'url'=>array('index')),
	array('label'=>'Create Membergroup', 'url'=>array('create')),
	array('label'=>'Update Membergroup', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Membergroup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Membergroup', 'url'=>array('admin')),
);
?>

<h1>View Membergroup #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'group_name',
		'status',
	),
)); ?>
