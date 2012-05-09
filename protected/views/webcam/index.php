<?php
$this->titleSidebar = 'Opérations';
$this->menu=array(
	array('label'=>'Create Webcam', 'url'=>array('create')),
	array('label'=>'Manage Webcam', 'url'=>array('admin')),
);
?>

<?php $data = $dataProvider->getData(); ?>

<h1>Webcams</h1>

<div id="leftBlock">

	<h1>Liste des webcams pour "<?php echo $data[0]->home->name ?>"</h1>
	<hr/>

	<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'summaryText'=>'',
	)); ?>
</div>