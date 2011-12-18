<?php
$this->breadcrumbs=array(
	'Classtimes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Classtime', 'url'=>array('index')),
	array('label'=>'Manage Classtime', 'url'=>array('admin')),
);
?>

<h1>Create Classtime</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>