<?php
/* @var $this MembergroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Membergroups',
);

$this->menu=array(
	array('label'=>'Create Membergroup', 'url'=>array('create')),
	array('label'=>'Manage Membergroup', 'url'=>array('admin')),
);
?>

<h1>Membergroups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
