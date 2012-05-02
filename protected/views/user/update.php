<?php
$this->breadcrumbs=array(
	'Gestion des utilisateurs'=>array('admin'),
	'Mise à jour d\'un utilisateur',
);

$this->menu=array(
	array('label'=>'Retour', 'url'=>array('admin')),
);
?>

<h1>Mise à jour de  <?php echo $model->username; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>