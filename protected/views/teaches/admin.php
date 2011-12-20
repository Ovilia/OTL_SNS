<?php
$this->pageTitle=Yii::app()->name . ' - 管理教师';
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
	$.fn.yiiGridView.update('teaches-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>修改#<?php echo $model->CID; ?>课程的已有教师信息</h1>

<?php echo CHtml::link('搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
	'teacher'=>$teacher,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'teaches-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'TID',
		array(
			'name'=>'教师姓名',
			'value'=>'$data->teacher->TEACHER_NAME',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}',
			'buttons'=>array(
				'update'=>array(
					'label'=>'编辑',
					'url'=>"array('teacher/update',
						'class_id'=>$model->CID," .
						'"teacher_id"=>$data->TID)',
				),
				'delete'=>array(
					'label'=>'删除',
					'url'=>"array('teaches/delete',
						'class_id'=>$model->CID," . 
						'"teacher_id"=>$data->TID)',
				),
			),
		),
	),
)); ?>
