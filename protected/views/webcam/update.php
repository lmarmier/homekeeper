<?php
$this->breadcrumbs=array(
	'Webcams'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Webcam', 'url'=>array('index')),
	array('label'=>'Create Webcam', 'url'=>array('create')),
	array('label'=>'View Webcam', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Webcam', 'url'=>array('admin')),
);
?>

<h1>Update Webcam <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>