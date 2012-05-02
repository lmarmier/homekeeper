<?php
$this->breadcrumbs=array(
	'Webcams'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Liste des Webcams', 'url'=>array('index')),
);

$date = new CDateFormatter('fr')

?>

<h1><?php echo $model->title; ?></h1>
<p><?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/sample.jpg', 'Webcams') ?></p>
Dernière image : <?php echo $date->formatDateTime(CHtml::encode($model->updated)) ?>