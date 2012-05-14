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
	'columns'=>array(
		'username',
		'firstName',
		'lastName',
		array(
			'class'=>'CDataColumn',
			'name'=>'homes.id',
			'value'=>'$row',
		),
		array(
			'class'=>'CButtonColumn',
			'deleteConfirmation'=>'Êtes-vous sûr de vouloir supprimer cet utilisateur ?',
		),
	),
)); ?>

	
</div>
