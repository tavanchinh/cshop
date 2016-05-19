<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Update Product', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Product', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
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
				'title',
				'image',
				'sku',
				'price',
				'create_date',
				'modify_date',
				'create_by',
				'modify_by',
				'feature',
				array(
                    'name' => 'description',
                    'type' => 'raw',  
                ),
				'status',
				'stock',
            	),
            )); ?>
        </div>
    </div>
    </div>
</div>
<div class="md-fab-wrapper">
    <a class="md-fab md-fab-accent" href="/cms/Product/update/id/<?php echo $model->id;?>">
        <i class="material-icons">mode_edit</i>
    </a>
</div>