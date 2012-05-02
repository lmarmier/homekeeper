<?php
$this->breadcrumbs=array(
	'Homes'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Home', 'url'=>array('index')),
	array('label'=>'Create Home', 'url'=>array('create')),
	array('label'=>'View Home', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Home', 'url'=>array('admin')),
);
?>

<h1>Update Home <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>