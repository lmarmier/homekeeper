<?php
$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Niveau d\'alerte',
		));
$this->widget('zii.widgets.CMenu', array(
    'items'=>array(
        array('label'=>'critical', 'url'=>array('', 'gravity'=>'critical')),
        array('label'=>'severe', 'url'=>array('', 'gravity'=>'severe')),
        array('label'=>'high', 'url'=>array('', 'gravity'=>'high')),
        array('label'=>'medium', 'url'=>array('', 'gravity'=>'medium')),
        array('label'=>'low', 'url'=>array('', 'gravity'=>'low')),
    ),
    'htmlOptions'=>array('class'=>'operations'),
));
$this->endWidget();
 ?>