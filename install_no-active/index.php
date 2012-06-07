<?php 
    require_once("settings.inc");    
    
    if (file_exists($config_file_path)) {
		header("location: delete.php");
        exit;
	}
 ?>

<html>
<head>
	<title>Assistant d'installation</title>
	<link rel="stylesheet" href="../css/homekeeper/main.css">
</head>
<body>
	<div class="container" id="page">

	<div id="header">
		<div id="logo">Bienvenue sur HomeKeeper</div>
	</div><!-- header -->
	<div id="mainmenu">
		
	</div><!-- mainmenu -->
	<div class="install">
		<p>
			Bienvenue sur l'application de surveillance de résience HomeKeeper. Cet assistant va vous conduire dans les configuration de base nécessaire à l'utilisation de cet outil. A la fin de cet assistant, vous aurez réalisé : <br />
			<ul>
				<li>Configuration de la base de données</li>
				<li>Création de votre mots de passe pour l'administration des utilisateurs</li>
			</ul>
			Afin de préparer au mieux cette installation, veuillez créer une base de données vide sur votre serveur.<br />
			Veuillez également vérifier que ces dossiers sont bien inscriptible:<br />
			<ul>
				<li>protected</li>
				<li>assets</li>
				<li>config</li>
				<li>runtime</li>
				<li>images et ses sous-dossier</li>
			</ul>
			<br />
			Une fois que vous êtes prêt, vous pouvez démarrer l'installation.
			<a href="install.php">Démarrer l'installation</a>
		</p>
	</div>
	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Lionel Marmier.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->
</body>
</html>