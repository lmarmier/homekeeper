<?php

$this->titleSidebar = 'Opérations';

$this->menu=array(
	array('label'=>'Liste des Webcams', 'url'=>array('index')),
	array('label'=>'Images fixes', 'url'=>array('img')),
);

$date = new CDateFormatter('fr')

?>

<h1><?php echo $model->title; ?></h1>

<div id="leftBlock">
	<h1>Emplacement : <?php echo $model->location ?></h1>
	<?php $this->renderPartial('_'.$model->brand, array('model'=>$model)); ?>
	<!-- Dernière image : <?php echo $date->formatDateTime(CHtml::encode($model->updated)) ?> -->
</div>