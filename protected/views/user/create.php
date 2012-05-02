<?php
$this->breadcrumbs=array(
	'Gestion des utilisateurs'=>array('admin'),
	'Ajouter un utilisateur',
);

$this->menu=array(
	array('label'=>'Retour', 'url'=>array('admin')),
);
?>

<h1>Ajouter un utilisateur</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>