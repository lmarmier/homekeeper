<?php
$this->breadcrumbs=array(
	'Homes'=>array('index'),
	'Ajouter une résidence',
);

$this->menu=array(
	array('label'=>'Retour', 'url'=>array('index')),
);
?>

<h1>Ajout d'une résidence</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'id'=>$id)); ?>