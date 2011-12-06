<?php
$this->breadcrumbs=array(
	'Messages'=>array('index'),
	$model->MID,
);

$this->menu=array(
	array('label'=>'List Message', 'url'=>array('index')),
	array('label'=>'Create Message', 'url'=>array('create')),
);
?>

<h1>View Message #<?php echo $model->MID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'MID',
		'UID',
		'USE_UID',
		'SEND_TIME',
		'ISREAD',
		'CONTENT',
	),
)); ?>
