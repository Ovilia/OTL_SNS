<?php
$this->breadcrumbs=array(
	'Teachers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Teacher', 'url'=>array('index')),
	array('label'=>'Manage Teacher', 'url'=>array('admin')),
);
?>

<h1>Create Teacher</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>