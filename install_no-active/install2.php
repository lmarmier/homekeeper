<?php

    require_once("settings.inc");    
    
    if (file_exists($config_file_path)) {        
		header("location: ".$application_start_file);
        exit;
	}
    
	$completed = false;
	$error_mg  = array();	
	
	if ($_POST['submit'] == "step2") {

		$database_host		= isset($_POST['database_host'])?$_POST['database_host']:"";
		$database_name		= isset($_POST['database_name'])?$_POST['database_name']:"";
		$database_username	= isset($_POST['database_username'])?$_POST['database_username']:"";
		$database_password	= isset($_POST['database_password'])?$_POST['database_password']:"";

		if (empty($database_host)){
			$error_mg[] = "Le serveur ne peux pas être vide.";	
		}
		
		if (empty($database_name)){
			$error_mg[] = "Le nom de la base de données ne peux pas être vide.";	
		}
		
		if (empty($database_username)){
			$error_mg[] = "Le nom d'utilisateurs ne peux pas être vide";	
		}
		
		if (empty($database_password)){
			$error_mg[] = "Le mots de passe ne peux pas être vide.";	
		}
		
		if(empty($error_mg)){
		
			$config_file = file_get_contents($config_file_default);
			$config_file = str_replace("_DB_HOST_", $database_host, $config_file);
			$config_file = str_replace("_DB_NAME_", $database_name, $config_file);
			$config_file = str_replace("_DB_USER_", $database_username, $config_file);
			$config_file = str_replace("_DB_PASSWORD_", $database_password, $config_file);
			
			$f = @fopen($config_file_path, "w+");
			if (@fwrite($f, $config_file) > 0){
                $link = @mysql_connect($database_host, $database_username, $database_password);
				if($link){					
					if (@mysql_select_db($database_name)) {                        
                        if(false == ($db_error = apphp_db_install($database_name, $sql_dump))){
                            $error_mg[] = "Impossible de trouver le fichier ".$sql_dump."! Merci de vérifier si ce fichier existe.";                            
                            @unlink($config_file_path);
                        }else{
                            if ($_POST['admin_password'] === $_POST['admin_password_repeat']) {
                              $password = $_POST['admin_password'];
                              mysql_query('INSERT INTO  `user` (`id` ,`firstName` ,`lastName` ,`username` ,`password`)
                                           VALUES (NULL ,  "'. $_POST['admin_firstname']. '",  "'. $_POST['admin_lastname']. '",  "admin",  "'. md5($password). '");');
                              $completed = true;
                            }else{
                              $completed = false;  
                              $error_mg[] = "Les mots de passe de l'administrateur ne corresponde pas";   
                            }                         
                        }
					} else {
						$error_mg[] = "Erreur de connexion à la base de donnée. Vérifier si la base de données existe</span><br/>";
                        @unlink($config_file_path);
					}
				} else {
					$error_mg[] = "Erreur de connexion à la base de données. Vérifier que vos paramètre de connexion sont correcte</span><br/>";
                    @unlink($config_file_path);
				}
			} else {				
				$error_mg[] = "Impossible d'ouvrir le fichier de configuration ".$config_file_directory.$config_file_name;				
			}
			@fclose($f);			
		}
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
		<?php 
			if(!$completed):			
				foreach($error_mg as $msg){
					echo $msg."<br />";
				}
			else:
		?>
		<p>
			L'installation de votre base de données s'est déroulée avec succès. Par mesure de sécurité, veuillez supprimer le dossier d'installation.<br />
      Une fois ceci fais, vous pouvez accéder à l'application et vous connecter grâce au nom d'utilisateur admin et au mots de passe que vous venez de définir.<br />
      Vous pouvez également créer un nouvel utilisateurs grâce à l'interface de gestion des utilisateurs.
			<a href="..">Accéder à l'application</a>
		</p>
	<?php endif; ?>
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

<?php

  function apphp_db_install($database, $sql_file) {
    $db_error = false;

//*
    if (!@apphp_db_select_db($database)) {
      if (@apphp_db_query('create database ' . $database)) {
        apphp_db_select_db($database);
      } else {
        $db_error = mysql_error();
        return false;		
      }
    }

    if (!$db_error) {
      if (file_exists($sql_file)) {
        $fd = fopen($sql_file, 'rb');
        $restore_query = fread($fd, filesize($sql_file));
         fclose($fd);
      } else {
          $db_error = 'Fichier SQL non trouvé : ' . $sql_file;
          return false;
      }
		
      $sql_array = array();
      $sql_length = strlen($restore_query);
      $pos = strpos($restore_query, ';');
      for ($i=$pos; $i<$sql_length; $i++) {
        if ($restore_query[0] == '#') {
          $restore_query = ltrim(substr($restore_query, strpos($restore_query, "\n")));
          $sql_length = strlen($restore_query);
          $i = strpos($restore_query, ';')-1;
          continue;
        }
        if ($restore_query[($i+1)] == "\n") {
          for ($j=($i+2); $j<$sql_length; $j++) {
            if (trim($restore_query[$j]) != '') {
              $next = substr($restore_query, $j, 6);
              if ($next[0] == '#') {
                // find out where the break position is so we can remove this line (#comment line)
                for ($k=$j; $k<$sql_length; $k++) {
                  if ($restore_query[$k] == "\n") break;
                }
                $query = substr($restore_query, 0, $i+1);
                $restore_query = substr($restore_query, $k);
                // join the query before the comment appeared, with the rest of the dump
                $restore_query = $query . $restore_query;
                $sql_length = strlen($restore_query);
                $i = strpos($restore_query, ';')-1;
                continue 2;
              }
              break;
            }
          }
          if ($next == '') { // get the last insert query
            $next = 'insert';
          }
          if ( (eregi('create', $next)) || (eregi('insert', $next)) || (eregi('drop t', $next)) ) {
            $next = '';
            $sql_array[] = substr($restore_query, 0, $i);
            $restore_query = ltrim(substr($restore_query, $i+1));
            $sql_length = strlen($restore_query);
            $i = strpos($restore_query, ';')-1;
          }
        }
      }

      for ($i=0; $i<sizeof($sql_array); $i++) {
		apphp_db_query($sql_array[$i]);
      }
      return true;
    } else {
      return false;
    }
    //*/

  }


  function apphp_db_select_db($database) {
    return mysql_select_db($database);
  }

  function apphp_db_query($query) {
    global $link;
    $res=mysql_query($query, $link);
    return $res;
  }

?>