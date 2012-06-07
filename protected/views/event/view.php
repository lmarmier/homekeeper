<?php
$date = new CDateFormatter('fr');

$this->breadcrumbs=array(
	Home::model()->findByAttributes(array('id'=>$model->home_id))->name => array('/home/view', 'id'=>$model->home_id),
	'Evenement'=>array('/event'),
	'Evenement du '.$date->formatDateTime($model->datetime, 'short', null). ' à '.  $date->formatDateTime($model->datetime, null, 'short'),
);

$this->titleSidebar = 'Opérations';
$this->menu=array(
	array('label'=>'Historique des événements', 'url'=>array('history', 'home_id'=>$model->home_id)),
);

?>

<h1>Evenement du <?php echo $date->formatDateTime($model->datetime, 'short', null). ' à '.  $date->formatDateTime($model->datetime, null, 'short') ?></h1>

<div id="leftBlock">
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
</div>