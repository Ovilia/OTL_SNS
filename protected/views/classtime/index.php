<?php
$this->breadcrumbs=array(
	'Classtimes',
);

$this->menu=array(
	array('label'=>'Create Classtime', 'url'=>array('create')),
	array('label'=>'Manage Classtime', 'url'=>array('admin')),
);
?>

<h1>Classtimes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
