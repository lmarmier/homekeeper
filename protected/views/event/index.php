<?php

$this->breadcrumbs=array(
	Home::model()->findByAttributes(array('id'=>$_SESSION['home_id']))->name => array('/home/view', 'id'=>$_SESSION['home_id']),
	'Evénements',
);

$this->titleSidebar = "Opérations";
$this->menu=array(
	array('label'=>'Historique des événements', 'url'=>array('history')),
	array('label'=>'Afficher les webcams', 'url'=>array('/webcam/index')),
	array('supprimer cette maison', 'url'=>array('/home/delete')),
);

?>

<h1>Derniers évenements pour "<?php echo CHtml::encode($home_name) ?>"</h1>

<?php

$this->renderPartial('_tableEvent',array(
	'dataProvider'=>$dataProvider,
	'emptyText'=>'Aucun événement récent pour cette maison...<br />',
));

?>

