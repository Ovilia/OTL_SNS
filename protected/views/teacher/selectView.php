<?php
$this->pageTitle=Yii::app()->name . ' - 选择教师';
$this->renderPartial('_menu');
$this->breadcrumbs=array(
	'返回修改课程安排'=>array('class/update', 'id'=>$class_id),
);
?>

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

<?php echo CHtml::ajaxButton("从已有的教师中选择",
	array('teacher/list', 'class_id'=>$class_id),
	array('update'=>'#teacher-selector')
); ?>
或者
<?php echo CHtml::ajaxButton("新增一个教师",
	array('teacher/create', 'class_id'=>$class_id),
	array('update'=>'#teacher-selector')
); ?>

<div id="teacher-selector">
<?php echo $this->renderPartial('_list', array(
		'model'=>$model, 'class_id'=>$class_id
	)
); ?>
</div>
