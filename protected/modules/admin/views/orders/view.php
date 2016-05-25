<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	'Orders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Orders', 'url'=>array('index')),
	array('label'=>'Create Orders', 'url'=>array('create')),
	array('label'=>'Update Orders', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Orders', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Orders', 'url'=>array('admin')),
);
?>

<div class="uk-grid">
    <div class="uk-width-1-1">
        <div class="md-card">        
        <div class="md-card-content">
            <h3 class="heading_a uk-margin-bottom">Thông tin chi tiết</h3>
            <?php $this->widget('zii.widgets.CDetailView', array(
        	   'data'=>$model,
        	   'attributes'=>array(
            				'id',
				'full_name',
				'phone_number',
				'address',
				'email',
				'user_id',
				'status',
				'note',
            	),
            )); ?>
        </div>
    </div>
    </div>
</div>
<div class="md-fab-wrapper">
    <a class="md-fab md-fab-accent" href="/cms/Orders/update/id/<?php echo $model->id;?>">
        <i class="material-icons">mode_edit</i>
    </a>
</div>