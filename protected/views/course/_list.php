<?php $this->widget('zii.widgets.grid.CGridView', array(
	'summaryText'=>'共有{count}个结果，下面显示{start}-{end}个:',
	'dataProvider'=>$classes,
	'columns'=>array(
		'CID',
		array(
			// I've wasted hours for the function implemented by
			// the next single line, goddamn it!
			'type'=>'raw',
			'name'=>'课程安排',
			'value'=>'$data->classAtomClassesToString()',
		),
		array(
			// Goddamn it again!
			'type'=>'raw',
			'name'=>'任课教师',
			'value'=>'$data->teachersToString()',
		),
		array(
			'class'=>'CLinkColumn',
			'label'=>'浏览',
			'urlExpression'=>'CHtml::normalizeUrl(array(
				"class/view",
				"id"=>$data->CID,
			))',
		),
		array(
			'class'=>'CLinkColumn',
			'label'=>'编辑',
			'urlExpression'=>'CHtml::normalizeUrl(array(
				"class/update",
				"id"=>$data->CID,
			))',
		),
	),
)); ?>
