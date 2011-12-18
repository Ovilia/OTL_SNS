<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'type'=>'raw',
			'label'=>'课程代号',
			'value'=>$model->course->COURSE_CODE,
		),
		array(
			'type'=>'raw',
			'label'=>'课程名称',
			'value'=>$model->course->COURSE_NAME,
		),
		array(
			'type'=>'raw',
			'label'=>'学年',
			'value'=>$model->course->YEAR,
		),
		array(
			'type'=>'raw',
			'label'=>'学期',
			'value'=>$model->course->SEMESTER,
		),
		array(
			'type'=>'raw',
			'label'=>'课程安排',
			'value'=>$model->classAtomClassesToString(),
		),
		array(
			'type'=>'raw',
			'label'=>'任课教师',
			'value'=>$model->teachersToString(),
		),
		array(
			'type'=>'raw',
			'value'=>CHtml::link("修改课程安排", array(
				'update', 'id'=>$model->CID,
			)),
		),
	),
)); ?>
