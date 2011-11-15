<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->UID,
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->UID)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->UID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
	array('label'=>'Feed User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('feed', 'uid'=>$model->UID),'confirm'=>'Are you sure you want to feed this guy?')),
);
?>

<h1>View User #<?php echo $model->UID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'UID',
		'LOGIN_NAME',
		'EMAIL',
		'PASSWORD',
		'REGISTER_TIME',
		'NICK_NAME',
		'ISADMIN',
	),
)); ?>
