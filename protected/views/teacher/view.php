<?php
$this->breadcrumbs=array(
	'Teachers'=>array('index'),
	$model->TID,
);

$this->menu=array(
	array('label'=>'List Teacher', 'url'=>array('index')),
	array('label'=>'Create Teacher', 'url'=>array('create')),
	array('label'=>'Update Teacher', 'url'=>array('update', 'id'=>$model->TID)),
	array('label'=>'Delete Teacher', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->TID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Teacher', 'url'=>array('admin')),
);
?>

<h1>View Teacher #<?php echo $model->TID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'TID',
		'TEACHER_NAME',
	),
)); ?>
