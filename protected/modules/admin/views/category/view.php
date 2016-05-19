<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create')),
	array('label'=>'Update Category', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Category', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Category', 'url'=>array('admin')),
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
				'name',
				'project_id',
            	),
            )); ?>
        </div>
    </div>
    </div>
</div>
<div class="md-fab-wrapper">
    <a class="md-fab md-fab-accent" href="/cms/Category/update/id/<?php echo $model->id;?>">
        <i class="material-icons">mode_edit</i>
    </a>
</div>