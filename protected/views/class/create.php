<?php
$this->breadcrumbs=array(
	'Aclasses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'查找课程', 'url'=>array('course/search')),
);
?>

<h1>Create AClass</h1>

<?php echo $this->renderPartial('_info', array('model'=>$model)); ?>
