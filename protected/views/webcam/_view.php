<div class="view">

	<h2><?php echo CHtml::encode($data->title); ?></h2>
	<p>Cette webcam se situe à l'emplacement suivant : "<?php echo CHtml::encode($data->location); ?>"</p>

	<p><?php echo CHtml::link('Voir la webcam', array('view', 'id'=>$data->id)) ?></p>

</div>