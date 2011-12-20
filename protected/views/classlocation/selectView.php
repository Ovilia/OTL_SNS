<?php
$this->pageTitle=Yii::app()->name . ' - 选择教室';
$this->renderPartial('_menu');
$this->breadcrumbs=array(
	'返回修改课程安排'=>array('class/update', 'id'=>$class_id),
	'返回选择时间'=>array('classtime/selectView', 'class_id'=>$class_id),
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

<?php echo CHtml::ajaxButton("从已有的教室中选择",
	array('classlocation/list', 
		'class_id'=>$class_id,
		'time_id'=>$time_id),
	array('update'=>'#classlocation-selector')
); ?>
或者
<?php echo CHtml::ajaxButton("新增一个教室",
	array('classlocation/create',
		'class_id'=>$class_id,
		'time_id'=>$time_id),
	array('update'=>'#classlocation-selector')
); ?>

<div id="classlocation-selector">
<?php echo $this->renderPartial('_list', array(
		'model'=>$model, 
		'class_id'=>$class_id, 
		'time_id'=>$time_id,
	)
); ?>
</div>
