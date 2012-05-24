<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'webcam-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php echo $form->textField($model,'location',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'location'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'ip'); ?>
		<?php echo $form->textField($model,'ip',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'ip'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'brand'); ?>
		<?php echo $form->dropDownList($model,'brand', array('axis'=>'axis','trendnet'=>'trendnet')); ?>
		<?php echo $form->error($model, 'brand'); ?>
	</div>

	<?php echo $form->hiddenField($model,'home_id', array('value'=>$_SESSION['home_id'])); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Enregistrer' : 'Modifier'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->