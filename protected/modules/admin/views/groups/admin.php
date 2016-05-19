<?php
/* @var $this GroupsController */
/* @var $model Groups */

$this->breadcrumbs=array(
	'Groups'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Groups', 'url'=>array('index')),
	array('label'=>'Create Groups', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#groups-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Quản lý nhóm</h1>
<?php echo CHtml::link('Thêm mới',Yii::app()->request->baseUrl.'/admin/'.$this->id.'/create',array('class'=>'add-button')); ?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'groups-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
         'name'=>'id',
         'htmlOptions'=>array('style'=>'width: 110px; text-align: center;'),
      ),
      array(
         'name'=>'name',
         'htmlOptions'=>array('style'=>'width: 140px; text-align: center;'),
      ),
      array(
         'name'=>'des',
         'htmlOptions'=>array('style'=>'width: 210px; text-align: center;'),
      ),
      array(
         'header' => '<a>Quyền</a>',
         'value' => array($this,'gridFunctional'),
      ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
