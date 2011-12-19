<?php
$this->breadcrumbs=array(
	'Teachers',
);

$this->menu=array(
	array('label'=>'Create Teacher', 'url'=>array('create')),
	array('label'=>'Manage Teacher', 'url'=>array('admin')),
);
?>

<h1>Teachers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
