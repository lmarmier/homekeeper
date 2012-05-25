<?php

$this->breadcrumbs=array(
	'Résidences'=>array('/home'),
		Home::model()->findByAttributes(array('id'=>$_SESSION['home_id']))->name,
);

$this->titleSidebar = 'Webcams';

$this->menu=array();
foreach ($webcams as $v) {
	$this->menu[] = array('label'=>'- '.$v->title, 'url'=>array('/webcam/view/', 'id'=>$v->id));
}


?>
<div id="imgHome">
	<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/home/'. $_SESSION['home_id']. '.jpg', 'home', array('height'=>50, 'class'=>'minWebcam')) ?>
</div>
<h1>Résumé de "<?php echo $model->name; ?>"</h1>
<div id="leftBlock">
<h1>Derniers événements pour cette résidence (<?php echo $dataProvider->getTotalItemCount(); ?> événements)</h1>
<hr />

<?php

//CVarDumper::dump(Yii::app()->user->returnUrl,10,true);
$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'lastEventGrid',
			'dataProvider'=>$dataProvider,
			'columns'=>array(
				array(
					'name'=>'Informations',
					'value'=>'$data->home->name. " - Un événement de type ". $data->type. " est survenu le ". date_create($data->datetime)->format("j M Y"). " à ". date_create($data->datetime)->format("h:m:s")',
				),
				array(
					'class'=>'CLinkColumn',
					'label'=>'Détails',
					'urlExpression'=>'array("/event/view", "id"=>$data->id)',
				),
				array(
					'value'=>'"/"'
				),
				array(
					'class'=>'CLinkColumn',
					'label'=>'Archiver',
					'urlExpression'=>'array("/event/check", "id"=>$data->id)',
				),
			),
			'rowCssClassExpression'=>'$data->gravity',
			'hideHeader'=>'true',
			'selectableRows'=>'0',
			'emptyText'=>'Auncun événement récent...',
			'htmlOptions'=>array(),
			'summaryText'=>'',
			'cssFile'=>Yii::app()->request->baseUrl. '/css/homekeeper/main.css',
		)
	);
?>
<?php echo CHtml::link('Voir l\'historique', array('/event/history'), array('class'=>'history')) ?>

<hr/>
	<div class="legend">
		<div class="legendItem"><span class="green">&nbsp;</span>Bas ou moyens</div><div class="legendItem"><span class="orange">&nbsp;</span>Haut</div><div class="legendItem"><span class="red">&nbsp;</span>Sévère ou critique</div>
	</div>

</div>