<div class="view">

	<h2><?php echo CHtml::encode($data->title); ?></h2>
	<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/sample.jpg', 'Webcams', array('width'=>70, 'class'=>'minWebcam')) ?>
	<p>Cette webcam se situe à l'emplacement suivant : "<?php echo CHtml::encode($data->location); ?>"</p>

	<p><?php echo CHtml::link('Voir la webcam', array('view', 'id'=>$data->id)) ?></p>

</div>