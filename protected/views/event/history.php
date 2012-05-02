<?php
$this->breadcrumbs=array(
	'Events',
);

$this->menu=array(
	array('label'=>'Retour', 'url'=>array('index')),
);
?>

<h1>Historique des évenements pour <?php echo CHtml::encode($home_name) ?></h1>

<p>Les événements se place automatiquement ici lorsque ils ont été visionner</p>

<?php
$this->renderPartial('_tableEvent',array(
	'dataProvider'=>$dataProvider,
));
$this->renderPartial('_filter');
?>