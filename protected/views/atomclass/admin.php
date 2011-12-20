<?php
$this->pageTitle=Yii::app()->name . ' - 修改已有的课程安排';
$this->renderPartial('_menu');
$this->breadcrumbs=array(
	'返回修改课程安排'=>array('class/update', 'id'=>$model->CID),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('atomclass-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>修改已有的课程安排</h1>

<?php echo CHtml::link('搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model, 'time'=>$time,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'atomclass-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'周数',
			'value'=>'$data->classtime->getWeekOfSemester()',
		),
		array(
			'name'=>'日期',
			'value'=>'$data->classtime->getDayOfWeek()',
		),
		array(
			'name'=>'开始时间',
			'value'=>'$data->classtime->START_TIME',
		),
		array(
			'name'=>'结束时间',
			'value'=>'$data->classtime->END_TIME',
		),
		'BUILDING_NUMBER',
		'CLASSROOM',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}',
		),
	),
)); ?>
