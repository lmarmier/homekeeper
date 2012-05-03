<div class="home">
	<?php $this->pageTitle=Yii::app()->name; ?>

	<h1>Gestion des utilisateurs</i></h1>

	<p>C'est ici que vous allez pourvoir gérer les personnes qui pourront se connecter à votre site.</p>

	<p>Afin de continuer, veuillez vous authentifier avec un login possédant les droits d'administration :</p>

	<div class="form" style="width:160px; margin:auto;">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
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

		<div class="row buttons">
			<?php echo CHtml::submitButton('Login'); ?>
		</div>

	<?php $this->endWidget(); ?>
	</div><!-- form -->
	<p><?php echo CHtml::link('Retour à l\'accueil', array('/user/admin')) ?></p>
</div>