<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	'Orders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Orders', 'url'=>array('index')),
	array('label'=>'Create Orders', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#orders-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Orders</h1>
<a class="add-button" href="create" title="Add new">Add new</a>
<div class="search-form uk-margin-bottom">
<?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->

<ul class="subsubsub">  
    <?php foreach($list_count_by_status as $value){?>
        <li><a <?php echo ($value['mode'] == $view_mode) ? 'class="active"' : ''?> href="/admin/orders/admin?view=<?php echo $value['mode']?>"><?php echo $value['text']?> (<?php echo $value['count']?>)</a></li>    
    <?php }?>
    
</ul>
<?php $pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'orders-grid',
	'dataProvider'=>$model->search(),
    'summaryText' =>'<span>Số dòng:</span>'.CHtml::dropDownList('pageSize',$pageSize,Yii::app()->params['pageSizes'],array('onchange'=>"$.fn.yiiGridView.update('".$this->id."-grid',{ data:{pageSize: $(this).val() }})",'class' => 'pagesize')).'{start} - {end} of {count}' ,
	'filter'=>$model,
	'columns'=>array(
		array(
            'name' => 'id',
            'header' => '<a href="#">Đơn hàng</a>',
            'value' => array($this,'gridInfo'),
            'type' => 'raw',
            'headerHtmlOptions' => array('style' => 'width:160px;text-align:left'),
        ),
        array(
            'name' => 'address',
            'type' => 'raw',
            'headerHtmlOptions' => array('style' => 'width:200px;text-align:left'),
            
        ),
        array(
            'name' => 'purchased',
            'header' => '<a href="#">Đặt mua</a>',
            'value' =>  array($this,'gridPurchased'),
            'type' => 'raw',
            'headerHtmlOptions' => array('style' => 'width:100px;text-align:left'),
            'filter' => false,
        ),
        
        array(
            'name' => 'note',
            'type' => 'raw',
            'filter' => false,
            'headerHtmlOptions' => array('style' => 'text-align:left'),
        ),
        array(
            'name' => 'create_date',
            'type' => 'raw',
            'value' => 'date("d/m/Y - H:i",strtotime($data->create_date))',
            'filter' => false,
            'headerHtmlOptions' => array('style' => 'text-align:left;width:130px'),
        ),
        
        array(
            'name' => 'amount',
            'header' => '<a href="#">Tổng tiền</a>',
            'value' =>  array($this,'gridAmount'),
            'type' => 'raw',
            'filter' => false,
            'headerHtmlOptions' => array('style' => 'text-align:left;width:100px'),
        ),
		/*
		array(
            'name' => 'status',
            'value' => '($data->status== 0) ? "No" : "Yes"', 
            'filter' => CHtml::dropDownList('Orders[status]',$model->status,array(
                    'No','Yes'
                ),
                array(
                    'empty' => '-- All --',
                    'style' => 'width:70px',
                )
         )),
		'note',
		*/
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}',
		),
	),
)); ?>
