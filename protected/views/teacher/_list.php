<?php $this->widget('zii.widgets.grid.CGridView', array(
	'summaryText'=>'共有{count}个可供选择的教师，下面显示{start}-{end}个:',
	'id'=>'teacher-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'TID',
		'TEACHER_NAME',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{choose}',
			'buttons'=>array(
				'choose'=>array(
					'label'=>'选择',
					'url'=>'array("choose",
						"teacher_id"=>$data->TID,
						"class_id"=>' . "$class_id)",
				),
			),
		),
	),
)); ?>
