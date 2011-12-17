<?php
$this->breadcrumbs=array(
	'Aclasses',
);

$this->menu=array(
	array('label'=>'Create AClass', 'url'=>array('create')),
	array('label'=>'Manage AClass', 'url'=>array('admin')),
);
?>

<h1>Aclasses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
