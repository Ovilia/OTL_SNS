<?php
$this->breadcrumbs=array(
	'Atomclasses'=>array('index'),
	$model->ACID=>array('view','id'=>$model->ACID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Atomclass', 'url'=>array('index')),
	array('label'=>'Create Atomclass', 'url'=>array('create')),
	array('label'=>'View Atomclass', 'url'=>array('view', 'id'=>$model->ACID)),
	array('label'=>'Manage Atomclass', 'url'=>array('admin')),
);
?>

<h1>Update Atomclass <?php echo $model->ACID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>