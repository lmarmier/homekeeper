<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/homekeeper/main.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo">Bienvenue sur <?php echo CHtml::encode(Yii::app()->name); ?></div>
		<div class="logout"><?php echo (!Yii::app()->user->isGuest)?'Bienvenue '. Yii::app()->user->name. ' - '. CHtml::link('Se déconnecter', array('/site/logout')):'' ?></div>
	</div><!-- header -->
	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Page d\'authentification', 'visible'=>(Yii::app()->getController()->getAction()->getId() == 'index' && Yii::app()->getController()->getId() == 'site'), 'itemOptions'=>array('class'=>'auth')),
				array('label'=>'Gestion des utilisateurs', 'visible'=>(Yii::app()->getController()->getAction()->getId() == 'userLogin' && Yii::app()->getController()->getId() == 'site'), 'itemOptions'=>array('class'=>'auth')),
				array('label'=>'Home', 'url'=>array('/'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Résidence', 'url'=>array('/home'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Evénements', 'url'=>array('/event'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Webcam', 'url'=>array('/webcam'), 'visible'=>!Yii::app()->user->isGuest),
				//array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="home">
		Maison séléctionnée : <?php echo (isset($_SESSION['home_id']))?Home::model()->findByAttributes(array('id'=>$_SESSION['home_id']))->name :'Aucune...'; ?>
	</div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Lionel Marmier.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
