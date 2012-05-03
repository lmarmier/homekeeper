<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'event-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		///*
		array(
			'class'=>'CLinkColumn',
			'imageUrl'=>Yii::app()->baseUrl.'/images/Clock-Small.png',
			'urlExpression'=>'array(\'check\', \'id\'=>$data->id)',
		),
		array(
			'name'=>'Information',
			'value'=>'"Un événement de type ".CHtml::encode($data->type)." est survenu le ". $data->datetime',
		),
		array(            // display a column with a link
            'class'=>'CLinkColumn',
            'label'=>'Voir l\'événement',
            'urlExpression'=>'array(\'view\', \'id\'=>$data->id)',
        ),
		//*/
	),
	'rowCssClassExpression'=>'$data->gravity',
	'hideHeader'=>'true',
	'selectableRows'=>'0',
	'emptyText'=>'Auncun événement...',
	'htmlOptions'=>array(),
));