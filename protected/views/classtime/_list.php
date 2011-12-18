<?php $this->widget('zii.widgets.grid.CGridView', array(
	'summaryText'=>'共有{count}个可供选择的时间，下面显示{start}-{end}种:',
	'id'=>'classtime-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'START_TIME',
		'END_TIME',
		array(
			'type'=>'raw',
			'name'=>'WEEK_OF_SEMESTER',
			'value'=>'$data->getWeekOfSemester()',
		),
		array(
			'type'=>'raw',
			'name'=>'DAY_OF_WEEK',
			'value'=>'$data->getDayOfWeek()',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{choose}',
			'buttons'=>array(
				'choose'=>array(
					'label'=>'选择',
					'url'=>'array("classtime/choose", "time_id"=>$data->TIMEID, "class_id"=>' . "$class_id)",
				),
			),
		),
	),
)); ?>
