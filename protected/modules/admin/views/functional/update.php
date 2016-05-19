<?php
/* @var $this FunctionalController */
/* @var $model Functional */

$this->breadcrumbs=array(
	'Functionals'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Functional', 'url'=>array('index')),
	array('label'=>'Create Functional', 'url'=>array('create')),
	array('label'=>'View Functional', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Functional', 'url'=>array('admin')),
);
?>

<h1>Update Functional <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>