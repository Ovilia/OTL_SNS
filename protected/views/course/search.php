<?php
$this->pageTitle=Yii::app()->name . ' - 查找课程';
$this->renderPartial('_menu');
?>

<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('course-grid', {
		data: $(this).serialize()
	});
	return true;
});
");
?>

<h1>课程</h1>

<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'summaryText'=>'共有{count}个结果，下面显示{start}-{end}个:',
	'id'=>'course-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'COURSE_CODE',
		'YEAR',
		'SEMESTER',
		'COURSE_NAME',
		array(
			'class'=>'CLinkColumn',
			'label'=>'浏览',
			'urlExpression'=>'CHtml::normalizeUrl(array(
				"course/view",
				"course_code"=>$data->COURSE_CODE,
				"year"=>$data->YEAR,
				"semester"=>$data->SEMESTER,
			))',
		),
	),
)); ?>
