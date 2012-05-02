<div class="view">
	<?php echo CHtml::link(CHtml::encode($data->name), array('/event/index', 'home_id'=>$data->id)) ?>
	(<?php echo CHtml::link('Evénements', array('/event/index', 'home_id'=>$data->id)) ?>/<?php echo CHtml::link('Webcams', array('/webcam/index', 'home_id'=>$data->id)) ?>)
</div>