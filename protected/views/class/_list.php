<h2>已有课程安排</h2>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'summaryText'=>'这门课的共有{count}次课，下面显示{start}-{end}次的课程安排:',
	'dataProvider'=>$atomclasses,
	'columns'=>array(
		array(
			'type'=>'raw',
			'name'=>'上课时间',
			'value'=>'$data->classTimeToString()',
		),
		array(
			'type'=>'raw',
			'name'=>'上课地点',
			'value'=>'$data->classLocationToString()',
		),
	),
)); ?>
