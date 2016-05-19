<?php
/* @var $this WebconfigController */
/* @var $model WebConfig */

$this->breadcrumbs=array(
	'Web Configs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List WebConfig', 'url'=>array('index')),
	array('label'=>'Manage WebConfig', 'url'=>array('admin')),
);
?>

<h1>Create WebConfig</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>