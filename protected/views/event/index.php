<?php

$this->menu=array(
	array('label'=>'Historique des événements', 'url'=>array('history')),
	array('label'=>'Afficher les webcams', 'url'=>array('/webcam/index')),
	array('supprimer cette maison', 'url'=>array('/home/delete')),
);

?>

<h1>Derniers évenements pour "<?php echo CHtml::encode($home_name) ?>"</h1>

<?php
/*
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_event',
	'emptyText'=>'Aucun événement récent pour cette maison...<br />',
));

//*/
?>
<?php

$this->renderPartial('_tableEvent',array(
	'dataProvider'=>$dataProvider,
	'emptyText'=>'Aucun événement récent pour cette maison...<br />',
));

?>

