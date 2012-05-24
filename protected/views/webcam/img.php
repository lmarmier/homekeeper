<?php

$this->titleSidebar = 'Opérations';

$this->menu=array(
	array('label'=>'Liste des Webcams', 'url'=>array('index')),
	array('label'=>'Images fixes', 'url'=>array('img')),
);

$date = new CDateFormatter('fr');

$dir = 'http://localhost:8888'. Yii::app()->request->baseUrl.'/images/home/';

?>

<h1>Dernière images pour cette webcam</h1>

<div id="leftBlock">

<table style="border-width: 1px; border-style: dashed; width: 100%;">
            <tr>
                <?php
                $i = -2;
                //$dir = opendir(Yii::app()->request->baseUrl.'/images/webcams/');
                echo $dir. '<br />';
                var_dump(is_dir($dir));

                /*
                if (is_dir($dir)) {
	                while ($file = @readdir($dir)) {
	                    $i++;
	                    if ($file != '.' && $file != '..') {
	                        //Récupération de l'extension du fichier
	                        $extension=substr(strrchr($file,'.'),1);
	                        //echo '<td align="center"><img src="./img/' . $file . '" alt="'. $file .'" width="100px" height="150px"/><br />';
	                        echo '<td align="center"><img src="img.php?img=' . $file . '&ext='. $extension. '" alt="'. $file .'" width="100px" height="150px"/><br />';
	                        echo $file. '</td>';
	                    }
	                    if ($i % 6 == 0 && $i != 0) {
	                        echo '</tr><tr>';
	                    }
	                }
                }
                //*/
                ?>
            </tr>
        </table>

</div>