<?php $this->beginContent('//homekeeper/main'); ?>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>$this->titleSidebar,
		));
		echo "<hr />";
		echo "<p class='introSidebar'>". $this->contentSidebar. "</p>";
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		echo (Yii::app()->getController()->getAction()->getId()==='home')?CHtml::link('Ajouter une résidence', array('/home/create'), array('class'=>'createHome')):'';
		$this->endWidget();

	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>