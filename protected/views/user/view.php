<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Suprimer l\'utilisateur', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Êtes-vous sûr de vouloir supprimer cet utilisateur ?')),
	array('label'=>'Retour', 'url'=>array('admin')),
);
?>

<h1>Information sur <?php echo $model->firstName. ' '. $model->lastName; ?></h1>
<div id="leftBlock">
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'username',
			'firstName',
			'lastName',
		),
	)); ?>
</div>