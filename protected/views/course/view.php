<?php
$this->pageTitle=Yii::app()->name . ' - 查看课程';
$this->renderPartial('_menu');
?>

<h1>课程</h1>

<div id="course-form">

<?php 
// initial the attributes for CDetailView
$attributes=array('COURSE_NAME', 'COURSE_CODE', 'YEAR', 'SEMESTER');
if (Yii::app()->user->role==="admin")
{
	$attr=array(
		'type'=>'raw',
		'value'=>CHtml::link('编辑该课程', array(
			'update',
			'course_code'=>$course->COURSE_CODE,
			'year'=>$course->YEAR,
			'semester'=>$course->SEMESTER,
		)),
	);
	array_push($attributes, $attr);

	$attr=array(
		'type'=>'raw',
		'value'=>CHtml::link('为该课程添加一项安排', array(
			'class/create',
			'course_code'=>$course->COURSE_CODE,
			'year'=>$course->YEAR,
			'semester'=>$course->SEMESTER,
		)),
	);
	array_push($attributes, $attr);
}
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$course,
	'attributes'=>$attributes,
)); ?>
</div>

<div id="classes-form">
<h2>该课程可供选择的课程安排如下:</h2>
<?php echo $this->renderPartial('_list', array('classes'=>$classes)); ?>
</div>
