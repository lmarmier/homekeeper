<h2>Vous avez l'occasion de modifier le commentaire ci-dessous.</h2>

<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment-form',
	'enableAjaxValidation'=>false,
)); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Mettre à jour'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>