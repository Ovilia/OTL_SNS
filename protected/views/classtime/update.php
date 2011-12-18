<?php
$this->breadcrumbs=array(
	'Classtimes'=>array('index'),
	$model->TIMEID=>array('view','id'=>$model->TIMEID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Classtime', 'url'=>array('index')),
	array('label'=>'Create Classtime', 'url'=>array('create')),
	array('label'=>'View Classtime', 'url'=>array('view', 'id'=>$model->TIMEID)),
	array('label'=>'Manage Classtime', 'url'=>array('admin')),
);
?>

<h1>Update Classtime <?php echo $model->TIMEID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>