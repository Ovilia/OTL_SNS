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

<?php echo $this->renderPartial('_info', array('model'=>$model)); ?>

<?php echo CHtml::link('添加一节课时',
	array('classtime/selectView', 'class_id'=>$model->CID)
); ?>
<?php echo CHtml::ajaxButton('修改已有的课时',
	array('classtime/admin'), array('update'=>'#classtime-editor')
); ?>

<div id='classtime-editor'></div>
