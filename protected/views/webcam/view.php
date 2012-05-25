<?php

$this->breadcrumbs=array(
	Home::model()->findByAttributes(array('id'=>$_SESSION['home_id']))->name => array('/home/view', 'id'=>$_SESSION['home_id']),
	'Webcams'=>array('index'),
	$model->title,
);

$this->titleSidebar = 'Opérations';

$this->menu=array(
	array('label'=>'Liste des Webcams', 'url'=>array('index')),
	array('label'=>'Images fixes', 'url'=>array('img', 'id'=>$model->id)),
);

$date = new CDateFormatter('fr')

?>

<h1><?php echo $model->title; ?></h1>

<p>
	L'image de la caméra s'actualise automatiquement après un laps de temps.
</p>

<div id="leftBlock">
	<h1>Emplacement : <?php echo $model->location ?></h1>
	<?php $this->renderPartial('_'.$model->brand, array('model'=>$model)); ?>
	<!-- Dernière image : <?php echo $date->formatDateTime(CHtml::encode($model->updated)) ?> -->
</div>