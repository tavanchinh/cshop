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
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn},
);\n";
?>

$this->menu=array(
	array('label'=>'List <?php echo $this->modelClass; ?>', 'url'=>array('index')),
	array('label'=>'Create <?php echo $this->modelClass; ?>', 'url'=>array('create')),
	array('label'=>'Update <?php echo $this->modelClass; ?>', 'url'=>array('update', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label'=>'Delete <?php echo $this->modelClass; ?>', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage <?php echo $this->modelClass; ?>', 'url'=>array('admin')),
);
?>

<div class="uk-grid">
    <div class="uk-width-1-1">
        <div class="md-card">        
        <div class="md-card-content">
            <h3 class="heading_a uk-margin-bottom">Thông tin chi tiết</h3>
            <?php echo "<?php"; ?> $this->widget('zii.widgets.CDetailView', array(
        	   'data'=>$model,
        	   'attributes'=>array(
            <?php
        foreach($this->tableSchema->columns as $column){
            if($column->name == 'content' || $column->name == 'description'){
                echo "\t\t\t\tarray(
                    'name' => '".$column->name."',
                    'type' => 'raw',  
                ),\n";
            }else{
                echo "\t\t\t\t'".$column->name."',\n";    
            }
        }
            	
            ?>
            	),
            )); ?>
        </div>
    </div>
    </div>
</div>
<div class="md-fab-wrapper">
    <a class="md-fab md-fab-accent" href="/cms/<?php echo $this->modelClass?>/update/id/<?php echo "<?php echo ".'$model->id;'. "?>"  ?>">
        <i class="material-icons">mode_edit</i>
    </a>
</div>