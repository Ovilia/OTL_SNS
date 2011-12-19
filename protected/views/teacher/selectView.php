<?php echo CHtml::ajaxButton("从已有的教师中选择",
	array('teacher/list', 'class_id'=>$class_id),
	array('update'=>'#teacher-selector')
); ?>
或者
<?php echo CHtml::ajaxButton("新增一个教师",
	array('teacher/create', 'class_id'=>$class_id),
	array('update'=>'#teacher-selector')
); ?>
或者
<?php echo CHtml::link("返回上一步",
	array('class/update',
		'id'=>$class_id)
); ?>

<div id="teacher-selector">
<?php echo $this->renderPartial('_list', array(
		'model'=>$model, 'class_id'=>$class_id
	)
); ?>
</div>
