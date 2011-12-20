<?php
$this->pageTitle=Yii::app()->name . ' - 管理教师';
$this->renderPartial('_menu');
$this->breadcrumbs=array(
	'返回修改课程安排'=>array('class/update', 'id'=>$class_id),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('teacher-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>修改#<?php echo $class_id; ?>课程的已有教师信息</h1>

<?php echo CHtml::link('搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'teacher-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'TID',
		'TEACHER_NAME',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
