<?php
/* @var $this WebconfigController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Web Configs',
);

$this->menu=array(
	array('label'=>'Create WebConfig', 'url'=>array('create')),
	array('label'=>'Manage WebConfig', 'url'=>array('admin')),
);
?>

<h1>Web Configs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
