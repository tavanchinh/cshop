<?php
/* @var $this FunctionalController */
/* @var $model Functional */

$this->breadcrumbs=array(
	'Functionals'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Functional', 'url'=>array('index')),
	array('label'=>'Create Functional', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#functional-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<h1>Quản lý chức năng</h1>
<?php echo CHtml::link('Thêm mới',Yii::app()->request->baseUrl.'/'.Yii::app()->controller->module->id.'/'.$this->id.'/create',array('class'=>'add-button')); ?>
<?php $pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'functional-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
   'summaryText' =>  '<span>Số dòng:</span>'.CHtml::dropDownList('pageSize',$pageSize,Yii::app()->params['pageSizes'],array('onchange'=>"$.fn.yiiGridView.update('".$this->id."-grid',{ data:{pageSize: $(this).val() }})",'class' => 'pagesize')).'{start} - {end} of {count}' ,
	'columns'=>array(
		'id',
		'name',
		'url',
		'controller_id',
		'action_id',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
