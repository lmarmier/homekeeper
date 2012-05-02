<?php
$this->breadcrumbs=array(
	'Webcams'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Webcam', 'url'=>array('index')),
	array('label'=>'Manage Webcam', 'url'=>array('admin')),
);
?>

<h1>Create Webcam</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>