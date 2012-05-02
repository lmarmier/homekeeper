<?php
$this->breadcrumbs=array(
	'Events'=>array('history', 'home_id'=>$model->home_id),
	$model->id,
);

$this->menu=array(
	array('label'=>'Historique des événements', 'url'=>array('history', 'home_id'=>$model->home_id)),
	array('label'=>'Manage Event', 'url'=>array('admin')),
);

$date = new CDateFormatter('fr');

?>

<h1>Evenement du <?php echo $date->formatDateTime($model->datetime, 'short', null). ' à '.  $date->formatDateTime($model->datetime, null, 'short') ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'type',
		'value',
		'gravity',
		'comment',
		'datetime',
	),
)); ?>
<br /><br />
<?php echo $this->renderPartial('_comment', array('model'=>$model)); ?>
