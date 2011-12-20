<?php
$this->pageTitle=Yii::app()->name . ' - 查看课程';
$this->menu=array(
	array('label'=>'查找课程', 'url'=>array('search')),
);
?>

<h1>课程</h1>

<div id="course-form">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$course,
	'attributes'=>array(
		'COURSE_NAME',
		'COURSE_CODE',
		'YEAR',
		'SEMESTER',
		array(
			'type'=>'raw',
			'value'=>CHtml::link('编辑该课程', array(
				'update',
				'course_code'=>$course->COURSE_CODE,
				'year'=>$course->YEAR,
				'semester'=>$course->SEMESTER,
			)),
		),
		array(
			'type'=>'raw',
			'value'=>CHtml::link('为该课程添加一项安排', array(
				'class/create',
				'course_code'=>$course->COURSE_CODE,
				'year'=>$course->YEAR,
				'semester'=>$course->SEMESTER,
			)),
		),
	),
)); ?>
</div>

<div id="classes-form">
<h2>该课程可供选择的课程安排如下:</h2>
<?php echo $this->renderPartial('_list', array('classes'=>$classes)); ?>
</div>
