<?php
$this->breadcrumbs=array(
	Home::model()->findByAttributes(array('id'=>$_SESSION['home_id']))->name => array('/home/view', 'id'=>$_SESSION['home_id']),
	'Webcams'=>array('/webcam'),
	'Ajouter une webcam',
);

$this->menu=array(
	array('label'=>'Retour', 'url'=>array('index')),
);
?>

<h1>Create Webcam</h1>


<div id="leftBlock">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>