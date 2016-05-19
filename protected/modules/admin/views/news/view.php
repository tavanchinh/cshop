<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'News'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List News', 'url'=>array('index')),
	array('label'=>'Create News', 'url'=>array('create')),
	array('label'=>'Update News', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete News', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage News', 'url'=>array('admin')),
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
				'avatar',
				'cat_id',
				'sapo',
				array(
                    'name' => 'content',
                    'type' => 'raw',  
                ),
				'create_date',
				'publish_date',
				'modify_date',
				'status',
				'create_by',
				'last_update_by',
            	),
            )); ?>
        </div>
    </div>
    </div>
</div>
<div class="md-fab-wrapper">
    <a class="md-fab md-fab-accent" href="/cms/News/update/id/<?php echo $model->id;?>">
        <i class="material-icons">mode_edit</i>
    </a>
</div>