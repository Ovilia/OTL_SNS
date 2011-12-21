<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->renderPartial('_menu');
?>

<h1>Create User</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>