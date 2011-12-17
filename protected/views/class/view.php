<?php
$this->breadcrumbs=array(
	'Aclasses'=>array('index'),
	$model->CID,
);

$this->menu=array(
	array('label'=>'List AClass', 'url'=>array('index')),
	array('label'=>'Create AClass', 'url'=>array('create')),
	array('label'=>'Update AClass', 'url'=>array('update', 'id'=>$model->CID)),
	array('label'=>'Delete AClass', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AClass', 'url'=>array('admin')),
);
?>

<h1>View AClass #<?php echo $model->CID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CID',
		'COURSE_CODE',
		'YEAR',
		'SEMESTER',
	),
)); ?>
