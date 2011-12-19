<?php
$this->breadcrumbs=array(
	'Aclasses'=>array('index'),
	$model->CID=>array('view','id'=>$model->CID),
	'Update',
);

$this->menu=array(
	array('label'=>'查找课程', 'url'=>array('course/search')),
);
?>

<h1>修改课程安排</h1>

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
			'label'=>"教师操作",
			'value'=>CHtml::link("修改任课教师", array(
					'teacher/selectView', 'class_id'=>$model->CID
				)) . "<br>" .
				CHtml::link("修改已有教师", array(
				)),
		),
		array(
			'type'=>'raw',
			'label'=>'课时操作',
			'value'=>CHtml::link("添加一节课时", array(
					'classtime/selectView', 'class_id'=>$model->CID,
				)) . "<br>" .
				CHtml::link("修改已有课时", array(
					'classtime/admin',
				)),
		),
	),
)); ?>

<div id='classtime-editor'></div>
