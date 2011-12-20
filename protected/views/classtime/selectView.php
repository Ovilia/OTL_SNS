<?php
// Display all flash messages.
$flashMessages = Yii::app()->user->getFlashes();
if ($flashMessages) {
	echo '<ul class="flashes">';
	foreach($flashMessages as $key => $message) {
		echo '<li><div class="flash-' . $key . '">' . $message . "</div></li>\n";
	}
	echo '</ul>';
}
?>

<?php
// An animation for displaying flash messages.
Yii::app()->clientScript->registerScript(
	'flashMsgHideEffect',
	'$(".flashes").animate({opacity: 1.0}, 3000).fadeOut("slow");',
	CClientScript::POS_READY
);
?>

<?php echo CHtml::ajaxButton("从已有的时间中选择",
	array('classtime/list', 'class_id'=>$class_id),
	array('update'=>'#classtime-selector')
); ?>
或者
<?php echo CHtml::ajaxButton("新增一个时间",
	array('classtime/create', 'class_id'=>$class_id),
	array('update'=>'#classtime-selector')
); ?>
或者
<?php echo CHtml::link("返回上一步",
	array('class/update',
		'id'=>$class_id)
); ?>

<div id="classtime-selector">
<?php echo $this->renderPartial('_list', array(
		'model'=>$model, 'class_id'=>$class_id
	)
); ?>
</div>
