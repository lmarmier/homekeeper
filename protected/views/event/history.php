<?php

$this->breadcrumbs=array(
	Home::model()->findByAttributes(array('id'=>$_SESSION['home_id']))->name => array('/home/view', 'id'=>$_SESSION['home_id']),
	'Historique',
);

$this->titleSidebar = 'Tri';

$this->menu=array(
	array('label'=>'- Tous les événements', 'url'=>array('')),
    array('label'=>'- Critique', 'url'=>array('', 'gravity'=>'critical')),
    array('label'=>'- Sévère', 'url'=>array('', 'gravity'=>'severe')),
    array('label'=>'- Haut', 'url'=>array('', 'gravity'=>'high')),
    array('label'=>'- Moyens', 'url'=>array('', 'gravity'=>'medium')),
    array('label'=>'- Bas', 'url'=>array('', 'gravity'=>'low')),
);
?>

<h1>Historique des évenements pour <?php echo CHtml::encode($home_name) ?></h1>

<p>Les événements se place automatiquement ici lorsque ils ont été visionner</p>

<?php
$this->renderPartial('_tableEvent',array(
	'dataProvider'=>$dataProvider,
));
//$this->renderPartial('_filter');
?>