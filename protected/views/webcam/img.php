<?php 
$this->breadcrumbs=array(
	Home::model()->findByAttributes(array('id'=>$_SESSION['home_id']))->name => array('/home/view', 'id'=>$_SESSION['home_id']),
	'Webcam'=>array('index'),
	Webcam::model()->findByAttributes(array('id' => $id))->title => array('/webcam/view', 'id'=>$id),
	'images fixes',
);
?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<?php echo CHtml::scriptFile(Yii::app()->request->baseUrl. '/js/zoombox/zoombox.js'); ?>

<script type="text/javascript">
	$(function($){
		//alert('test');
		$('a.zoombox').zoombox();
	});	
</script>

<?php

$this->titleSidebar = 'Opérations';

$this->menu=array(
	array('label'=>'Retour', 'url'=>array('view', 'id'=>$id)),
);

$date = new CDateFormatter('fr');

?>

<h1>Dernière images pour cette webcam</h1>

<p>
	Ci-dessous, les 12 dernières images prise par votre caméra. Ces images ont été prise lors d'événement déclancher par la caméra.
</p>

<div id="leftBlock">

<?php
$i = -2;
if(is_dir('images/webcams/'.$id)){
	$dir = opendir('images/webcams/'.$id);
?>

<table style="border-width: 1px; border-style: dashed; width: 100%;">
            <tr>
                <?php

                //*
	            while (($file = @readdir($dir)) && $i <= 12) {
			        $i++;
			        if ($file != '.' && $file != '..') {
			        	echo '<td align="center">'. CHtml::link(CHtml::image(Yii::app()->baseUrl.'/images/webcams/'.$id.'/'.$file, 'webcam_img', array('width'=>140)), Yii::app()->baseUrl.'/images/webcams/'.$id.'/'.$file, array('class'=>'zoombox zgallery1')). '</td>';
			        }
			        if ($i % 4 == 0 && $i != 0) {
			        	echo '</tr><tr>';
			        }
	            }	
                //*/
                
                
                ?>
            </tr>
        </table>
<?php 
}
else{
	echo 'Aucune image pour cette webcam';
}
?>


</div>