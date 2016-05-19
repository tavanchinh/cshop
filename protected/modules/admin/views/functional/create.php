<?php
/* @var $this FunctionalController */
/* @var $model Functional */

$this->breadcrumbs=array(
	'Functionals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Functional', 'url'=>array('index')),
	array('label'=>'Manage Functional', 'url'=>array('admin')),
);
?>

<h1>Create Functional</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>