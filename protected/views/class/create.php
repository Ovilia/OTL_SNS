<?php
$this->breadcrumbs=array(
	'Aclasses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AClass', 'url'=>array('index')),
	array('label'=>'Manage AClass', 'url'=>array('admin')),
);
?>

<h1>Create AClass</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>