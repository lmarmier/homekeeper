<?php
$this->titleSidebar = 'Opérations';
$this->menu=array(
	array('label'=>'Ajouter une Webcam', 'url'=>array('create')),
);
?>

<h1>Webcams</h1>

<div id="leftBlock">

	<h1>Liste des webcams pour "<?php echo Home::model()->findByAttributes(array('id'=>$_SESSION['home_id']))->name ?>"</h1>
	<hr/>

	<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'summaryText'=>'',
	'emptyText'=>'Aucune webcam pour cette maison...<br />',
	)); ?>
</div>