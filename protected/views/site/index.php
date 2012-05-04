<div class="home">
	<?php $this->pageTitle=Yii::app()->name; ?>
	<div class="intro">
		<p>Cette interface va vous permettre de surveiller vos résidences à distance</p>

		<p>Afin de continuer, veuillez vous authentifier :</p>
	</div>

	<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
		'action'=>array('site/login'),
	)); ?>

		<div class="row">
			<?php echo $form->labelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username'); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'password'); ?>
			<?php echo $form->passwordField($model,'password'); ?>
			<?php echo $form->error($model,'password'); ?>
		</div>

		<div class="row rememberMe">
			<?php echo $form->checkBox($model,'rememberMe'); ?>
			<?php echo $form->label($model,'rememberMe'); ?>
			<?php echo $form->error($model,'rememberMe'); ?>
		</div>

		<div class="row buttons">
			<?php echo CHtml::submitButton('Se connecter'); ?>
		</div>

	<?php $this->endWidget(); ?>
	<?php echo CHtml::link('>> Gestion des utilisateurs', array('/site/userLogin')) ?>
	</div><!-- form -->
</div>