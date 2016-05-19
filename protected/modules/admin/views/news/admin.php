<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'News'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List News', 'url'=>array('index')),
	array('label'=>'Create News', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#news-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage News</h1>
<a class="add-button" href="create" title="Add new">Add new</a>
<?php $pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'news-grid',
	'dataProvider'=>$model->search(),
    'summaryText' =>'<span>Số dòng:</span>'.CHtml::dropDownList('pageSize',$pageSize,Yii::app()->params['pageSizes'],array('onchange'=>"$.fn.yiiGridView.update('".$this->id."-grid',{ data:{pageSize: $(this).val() }})",'class' => 'pagesize')).'{start} - {end} of {count}' ,
	'filter'=>$model,
	'columns'=>array(
		array(
            'name' => 'id',
            'htmlOptions' => array('style' => 'width:60px;text-align:center'),
        ),
        array(
            'name' => 'avatar',
            'value' => array($this,'gridImage'),
            'type' => 'raw',
            'htmlOptions' => array('style' => 'width:100px;text-align:center'),
        ),
		'title',
        
		array(
            'name' => 'status',
            'value' => array($this,'gridStatus'),
            'type' => 'raw',
            'filter' => CHtml::dropDownList('News[status]',$model->status,News::model()->list_status,array(
                'empty' => '--Tất cả--'
            ))
        ),
		/*
		'create_date',
		'publish_date',
		'modify_date',
		array(
            'name' => 'status',
            'value' => '($data->status== 0) ? "No" : "Yes"', 
            'filter' => CHtml::dropDownList('News[status]',$model->status,array(
                    'No','Yes'
                ),
                array(
                    'empty' => '-- All --',
                    'style' => 'width:70px',
                )
         )),
		'create_by',
		'last_update_by',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
