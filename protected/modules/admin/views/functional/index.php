<?php
/* @var $this FunctionalController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Functionals',
);

$this->menu=array(
	array('label'=>'Create Functional', 'url'=>array('create')),
	array('label'=>'Manage Functional', 'url'=>array('admin')),
);
?>

<h1>Functionals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
