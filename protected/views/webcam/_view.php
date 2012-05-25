<div class="view">
	<h2><?php echo CHtml::encode($data->title). ' / '. CHtml::link('Supprimer', array('delete', 'id'=>$data->id)); ?></h2>
	<?php
	switch($data->brand){
		case 'axis':
			echo CHtml::image('http://'. $data->ip. '/axis-cgi/jpg/image.cgi?resolution=160x120', 'Webcams', array('width'=>70, 'class'=>'minWebcam'));
			break;
		case 'trendnet':
			echo CHtml::image('http://'. $data->ip. '/axis-cgi/jpg/image.cgi?resolution=160x120', 'Webcams', array('width'=>70, 'class'=>'minWebcam'));
			break;
	}
	?>
	<p>Cette webcam se situe à l'emplacement suivant : "<?php echo CHtml::encode($data->location); ?>"</p>

	<p><?php echo CHtml::link('Voir la webcam', array('view', 'id'=>$data->id)) ?></p>

</div>