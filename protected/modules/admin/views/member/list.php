<?php
/* @var $this MemberController */
/* @var $model Member */

$this->breadcrumbs=array(
	'Members'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Member', 'url'=>array('index')),
	array('label'=>'Create Member', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#member-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Members</h1>

<?php echo CHtml::link('Thêm mới',Yii::app()->request->baseUrl.'/cms/'.$this->id.'/create/group/'.$group_id,array('class'=>'add-button')); ?>
<?php $pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'member-grid',
	'dataProvider'=> $dataProvider, //$model->getListByGroupID(1),
	'filter'=>$model,
   'summaryText' =>  '<span>Số dòng:</span>'.CHtml::dropDownList('pageSize',$pageSize,Yii::app()->params['pageSizes'],array('onchange'=>"$.fn.yiiGridView.update('".$this->id."-grid',{ data:{pageSize: $(this).val() }})",'class' => 'pagesize')).'{start} - {end} of {count}' ,
	'columns'=>array(
		array(
            'name'=>'id',
            'htmlOptions'=>array('style'=>'width: 110px; text-align: center;'),
        ),
        array(
            'name' => 'display_name',
            'header' => '<a>Tên</a>',
            'value' => array($this,'gridName'),
            'type' => 'raw',
        ),	    
		'email',
        array(
            'name'=>'group_id',
            'header' => '<a>Nhóm</a>',
            'value' => array($this,'gridGroup'),
            'filter'=> false,
        ),
		array(
			'class'=>'CButtonColumn',
            'template' => '{view}{update}'
		),
	),
)); ?><strong></strong>
