<?php 
    require_once("settings.inc");    
    
    if (file_exists($config_file_path)) {
		header("location: ".$application_start_file);
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
			La première étapes d'installation consiste à configurer votre base de données. Veuillez remplir correctement le formulaire ci-dessous et cliquez sur suivant.<br />
			<div class="form">
				<form action="install2.php" method="post">
					<input type="hidden" name="submit" value="step2" />
					<label>Serveur :</label><input type="text" name="database_host" value="localhost"><br />
					<label>Nom de la base de données :</label><input type="text" name="database_name"><br />
					<label>Nom d'utilisateur :</label><input type="text" name="database_username"><br />
					<label>Mots de passe :</label><input type="text" name="database_password"><br />
					<input type="submit" value="Suivant..." class="buttons">
				</form>
			</div>
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