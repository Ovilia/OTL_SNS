<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->UID=>array('view','id'=>$model->UID),
	'Update',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'View User', 'url'=>array('view', 'id'=>$model->UID)),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>Update User <?php echo $model->UID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>