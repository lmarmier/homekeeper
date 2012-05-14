<?php

$this->titleSidebar = "Opérations";

$this->menu=array(
	array('label'=>'Retour', 'url'=>array('index')),
);
?>

<h1>Ajout d'une résidence</h1>

<div id="leftBlock">
	<?php echo $this->renderPartial('_form', array('model'=>$model, 'id'=>$id)); ?>
</div>