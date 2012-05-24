<?php
$this->menu=array(
	array('label'=>'Retour', 'url'=>array('index')),
);
?>

<h1>Create Webcam</h1>


<div id="leftBlock">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>