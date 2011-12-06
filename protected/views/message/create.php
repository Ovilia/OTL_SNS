<?php
$this->breadcrumbs=array(
	'Messages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Message', 'url'=>array('index')),
);
?>

<h1>Create Message</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
