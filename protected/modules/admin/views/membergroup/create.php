<?php
/* @var $this MembergroupController */
/* @var $model Membergroup */

$this->breadcrumbs=array(
	'Membergroups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Membergroup', 'url'=>array('index')),
	array('label'=>'Manage Membergroup', 'url'=>array('admin')),
);
?>

<h1>Create Membergroup</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>