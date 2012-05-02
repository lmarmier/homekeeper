<?php
$this->breadcrumbs=array(
	'Webcams',
);

$this->menu=array(
	array('label'=>'Create Webcam', 'url'=>array('create')),
	array('label'=>'Manage Webcam', 'url'=>array('admin')),
);
?>

<h1>Webcams</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
