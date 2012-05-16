<?php

$this->titleSidebar = "Opérations";

$this->menu=array(
	array('label'=>'Ajouter un utilisateurs', 'url'=>array('create')),
);
?>

<h1>Gestion des utilisateurs</h1>

<div id="leftBlock">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'summaryText'=>'Utilisateurs {start} - {end} sur un total de {count}',
	//'itemsCssClass'=>Yii::app()->request->baseUrl. '/css/homekeeper/screen.css',
	'columns'=>array(
		'firstName',
		'lastName',
		'username',
		array(
			'class'=>'CButtonColumn',
			'deleteConfirmation'=>'Êtes-vous sûr de vouloir supprimer cet utilisateur ?',
			'updateButtonLabel'=>false,
			'updateButtonImageUrl'=>false,
		),
	),
)); ?>

	
</div>
