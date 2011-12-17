<?php
$this->breadcrumbs=array(
	'Aclasses'=>array('index'),
	$model->CID=>array('view','id'=>$model->CID),
	'Update',
);

$this->menu=array(
	array('label'=>'List AClass', 'url'=>array('index')),
	array('label'=>'Create AClass', 'url'=>array('create')),
	array('label'=>'View AClass', 'url'=>array('view', 'id'=>$model->CID)),
	array('label'=>'Manage AClass', 'url'=>array('admin')),
);
?>

<h1>Update AClass <?php echo $model->CID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>