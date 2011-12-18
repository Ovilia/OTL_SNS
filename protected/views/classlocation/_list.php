<?php $this->widget('zii.widgets.grid.CGridView', array(
	'summaryText'=>'共有{count}个可供选择的教室，下面显示{start}-{end}个:',
	'id'=>'classlocation-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'BUILDING_NUMBER',
		'CLASSROOM',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{choose}',
			'buttons'=>array(
				'choose'=>array(
					'label'=>'选择',
					'url'=>'array("classlocation/choose",
						"building"=>$data->BUILDING_NUMBER,
						"classroom"=>$data->CLASSROOM,
						"class_id"=>' . "$class_id," .
						'"time_id"=>' . "$time_id)",
				),
			),
		),
	),
)); ?>
