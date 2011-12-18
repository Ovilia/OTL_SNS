<?php
$this->breadcrumbs=array(
	'Classtimes'=>array('index'),
	$model->TIMEID,
);

$this->menu=array(
	array('label'=>'List Classtime', 'url'=>array('index')),
	array('label'=>'Create Classtime', 'url'=>array('create')),
	array('label'=>'Update Classtime', 'url'=>array('update', 'id'=>$model->TIMEID)),
	array('label'=>'Delete Classtime', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->TIMEID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Classtime', 'url'=>array('admin')),
);
?>

<h1>View Classtime #<?php echo $model->TIMEID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'TIMEID',
		'START_TIME',
		'END_TIME',
		'DAY_OF_WEEK',
		'WEEK_OF_SEMESTER',
	),
)); ?>
