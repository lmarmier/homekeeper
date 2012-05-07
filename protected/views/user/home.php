<?php
$this->titleSidebar = "Mes résidences";
$this->contentSidebar = "Voici la liste de vos résidence, en cliquant dessus, vous accéderez à la liste de leurs événements respectifs. Vous aurez également accès aux webcams et à l’historique des ces résidences.";

$this->menu = array();
foreach ($homes as $v) {
	$this->menu[] = array('label'=>'- '.$v->name, 'url'=>array('home/view/', 'id'=>$v->id));
}
?>

<p>Bienvenue sur l’interface de gestion de vos résidences. Cette page regroupe l’ensemble des informations importantes dont vous pourriez avoir besoins.</p>

<div id="lastEvent">

<p class="title">Derniers événements</p>
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
			'emptyText'=>'Auncun événement...',
			'htmlOptions'=>array(),
			'summaryText'=>'',
			'cssFile'=>Yii::app()->request->baseUrl. '/css/homekeeper/main.css',
		)
	);
?>

<a href="#" class="history">Voir l'historique</a>

<hr/>
<div class="legend">
	<div class="legendItem"><span class="green">&nbsp;</span>Bas ou moyens</div><div class="legendItem"><span class="orange">&nbsp;</span>Haut ou critique</div><div class="legendItem"><span class="red">&nbsp;</span>Sévère</div>
</div>

</div>