<?php
$this->menu=array(
	array('label'=>'查找', 'url'=>array('index')),
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
	),
)); ?>
</div>

<div id="classes-form">
<h2>该课程可供选择的课程安排如下:</h2>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'summaryText'=>'共有{count}个结果，下面显示{start}-{end}页:',
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
	),
)); ?>
</div>
