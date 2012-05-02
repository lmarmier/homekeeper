<div class="view <?php echo $data->gravity ?>">
	<?php $date = new CDateFormatter('fr') ?>

	Un événement de type <?php echo CHtml::encode($data->type) ?> est survenu le <?php echo $date->formatDateTime(CHtml::encode($data->datetime), 'full', null) ?> à <?php echo $date->formatDateTime(CHtml::encode($data->datetime), null) ?>. (<?php echo CHtml::link('Détails', array('view', 'id'=>$data->id)) ?>)

</div>