<?php
/* @var $this WebconfigController */
/* @var $model WebConfig */

$this->breadcrumbs=array(
	'Web Configs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List WebConfig', 'url'=>array('index')),
	array('label'=>'Create WebConfig', 'url'=>array('create')),
	array('label'=>'View WebConfig', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage WebConfig', 'url'=>array('admin')),
);
?>

<h1>Update WebConfig <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>