<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

<?php
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Manage',
);\n";
?>

$this->menu=array(
	array('label'=>'List <?php echo $this->modelClass; ?>', 'url'=>array('index')),
	array('label'=>'Create <?php echo $this->modelClass; ?>', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#<?php echo $this->class2id($this->modelClass); ?>-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage <?php echo $this->pluralize($this->class2name($this->modelClass)); ?></h1>
<a class="add-button" href="create" title="Add new">Add new</a>
<?php echo "<?php ". '$pageSize=Yii::app()->user->getState(\'pageSize\',Yii::app()->params[\'defaultPageSize\']);'."?>\n"?>
<?php echo "<?php"; ?> $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
    'summaryText' =>'<span>Số dòng:</span>'.CHtml::dropDownList('pageSize',$pageSize,Yii::app()->params['pageSizes'],array('onchange'=>"$.fn.yiiGridView.update('".$this->id."-grid',{ data:{pageSize: $(this).val() }})",'class' => 'pagesize')).'{start} - {end} of {count}' ,
	'filter'=>$model,
	'columns'=>array(
<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if(++$count==7)
    {
        echo "\t\t/*\n";
    }
    if($column->name == 'id'){
        
        echo "\t\tarray(
            'name' => 'id',
            'htmlOptions' => array('style' => 'width:60px;text-align:center'),
        ),\n";
    }elseif ($column->name == 'status'){
        
        echo "\t\tarray(
            'name' => 'status',
            'value' => '(".'$data->status'."== 0) ? \"No\" : \"Yes\"', 
            'filter' => CHtml::dropDownList('".$this->getModelClass()."[status]',".'$model->status'.",array(
                    'No','Yes'
                ),
                array(
                    'empty' => '-- All --',
                    'style' => 'width:70px',
                )
         )),\n";
    }
    else{
        echo "\t\t'".$column->name."',\n";
    }
	
}
if($count>=7)
	echo "\t\t*/\n";
?>
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
