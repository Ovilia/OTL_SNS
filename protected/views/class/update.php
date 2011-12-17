<?php
$this->breadcrumbs=array(
	'Aclasses'=>array('index'),
	$model->CID=>array('view','id'=>$model->CID),
	'Update',
);

$this->menu=array(
	array('label'=>'查找课程', 'url'=>array('course/search')),
);
?>

<h1>修改课程安排</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'atomclasses'=>$atomclasses)); ?>
