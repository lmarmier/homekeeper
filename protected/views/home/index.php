<?php
$this->breadcrumbs=array(
	'Home',
);
$this->menu=array(
	array('label'=>'Ajouter une résidences', 'url'=>array('create')),
);
?>
<h1>Liste des résidences vous appartenant</h1>

<p>

	<?php

	$this->widget('zii.widgets.CListView', 
		array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_home',
			'emptyText'=>'Vous ne posséder aucune résidences enregistrées.<br />',
	)); 

	?>

</p>
