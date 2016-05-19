<?php
/* @var $this WebconfigController */
/* @var $model WebConfig */

$this->breadcrumbs=array(
	'Web Configs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List WebConfig', 'url'=>array('index')),
	array('label'=>'Create WebConfig', 'url'=>array('create')),
	array('label'=>'Update WebConfig', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete WebConfig', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WebConfig', 'url'=>array('admin')),
);
?>

<h1>View WebConfig #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'web_title',
		'meta_description',
		'meta_keyword',
		'page_size_home',
      'number_related',
      array(
         'name' => 'contact_ads',
         'type' => 'raw',
      ),
      array(
         'name' => 'cooperate_content',
         'type' => 'raw',
      ),
      array(
         'name' => 'copyright_content',
         'type' => 'raw',
      ),
      array(
         'name' => 'general_rule',
         'type' => 'raw',
      ),
	),
)); ?>
