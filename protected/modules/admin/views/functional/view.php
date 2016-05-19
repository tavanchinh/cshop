<?php
/* @var $this FunctionalController */
/* @var $model Functional */

$this->breadcrumbs=array(
	'Functionals'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Functional', 'url'=>array('index')),
	array('label'=>'Create Functional', 'url'=>array('create')),
	array('label'=>'Update Functional', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Functional', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Functional', 'url'=>array('admin')),
);
?>

<h1>View Functional #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'url',
		'controller_id',
		'action_id',
	),
)); ?>
