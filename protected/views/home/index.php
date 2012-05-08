<?php
$this->titleSidebar = "Opérations";
$this->contentSidebar = 'test';
$this->menu=array(
	array('label'=>'- Ajouter une résidences', 'url'=>array('create')),
);
?>

<div id="flash">
	<?php echo Yii::app()->user->getFlash('noHome'); ?>
</div>

<p>Ici vous pouvez voir la liste des résidences que vous possédez. En cliquant sur une résidence, vous accéderez à l'interface de surveillance de celle-ci.</p>

<div id="leftBlock">
<h1>Liste des résidences vous appartenant</h1>
<hr/>
<p>

	<?php

	$this->widget('zii.widgets.CListView', 
		array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_home',
			'emptyText'=>'Vous ne posséder aucune résidences enregistrées.<br />',
			'summaryText'=>'',
	)); 

	?>

</p>
</div>