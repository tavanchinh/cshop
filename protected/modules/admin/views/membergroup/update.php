<?php
/* @var $this MembergroupController */
/* @var $model Membergroup */

$this->breadcrumbs=array(
	'Membergroups'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Membergroup', 'url'=>array('index')),
	array('label'=>'Create Membergroup', 'url'=>array('create')),
	array('label'=>'View Membergroup', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Membergroup', 'url'=>array('admin')),
);
?>

<h1>Update Membergroup <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>