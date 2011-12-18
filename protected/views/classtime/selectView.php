<?php echo CHtml::ajaxButton("从已有的时间中选择",
	array('classtime/list', 'class_id'=>$class_id),
	array('update'=>'#classtime-selector')
); ?>
或者
<?php echo CHtml::ajaxButton("新增一个时间",
	array('classtime/create', 'class_id'=>$class_id),
	array('update'=>'#classtime-selector')
); ?>
<div id="classtime-selector">
<?php echo $this->renderPartial('_list', array(
		'model'=>$model, 'class_id'=>$class_id
	)
); ?>
</div>
