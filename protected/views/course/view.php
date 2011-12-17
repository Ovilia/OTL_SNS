<?php
$this->menu=array(
	array('label'=>'查找', 'url'=>array('index')),
);
?>

<h1>课程</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$course,
	'attributes'=>array(
		'COURSE_NAME',
		'COURSE_CODE',
		'YEAR',
		'SEMESTER',
	),
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$classes,
	'columns'=>array(
		'CID',
		'COURSE_CODE',
		'YEAR',
		'SEMESTER',
	),
)); ?>
