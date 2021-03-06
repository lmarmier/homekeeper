<div id="leftBlock">

<h1>Derniers événements</h1>
<hr />

<?php 

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
					'value'=>'"/"',
					'visible'=>(Yii::app()->getController()->getAction()->getId() != 'history'),
				),
				array(
					'class'=>'CLinkColumn',
					'label'=>'Archiver',
					'urlExpression'=>'array("/event/check", "id"=>$data->id)',
					'visible'=>(Yii::app()->getController()->getAction()->getId() != 'history'),
				),
			),
			'rowCssClassExpression'=>'$data->gravity',
			'hideHeader'=>true,
			'selectableRows'=>'0',
			'emptyText'=>'Auncun événement...',
			'htmlOptions'=>array(),
			'summaryText'=>'',
			'cssFile'=>Yii::app()->request->baseUrl. '/css/homekeeper/main.css',
		)
	);
?>
<?php echo CHtml::link('Retour', array('/home/view', 'id'=>$_SESSION['home_id']), array('class'=>'history')) ?>

<hr/>
	<div class="legend">
		<div class="legendItem"><span class="green">&nbsp;</span>Bas ou moyens</div><div class="legendItem"><span class="orange">&nbsp;</span>Haut</div><div class="legendItem"><span class="red">&nbsp;</span>Sévère ou critique</div>
	</div>

</div>