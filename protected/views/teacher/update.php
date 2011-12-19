<?php
$this->breadcrumbs=array(
	'Teachers'=>array('index'),
	$model->TID=>array('view','id'=>$model->TID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Teacher', 'url'=>array('index')),
	array('label'=>'Create Teacher', 'url'=>array('create')),
	array('label'=>'View Teacher', 'url'=>array('view', 'id'=>$model->TID)),
	array('label'=>'Manage Teacher', 'url'=>array('admin')),
);
?>

<h1>Update Teacher <?php echo $model->TID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>