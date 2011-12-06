<?php
$this->pageTitle=Yii::app()->name . ' - ' . $name;
$this->breadcrumbs=array(
	'Messages',
);

$this->menu=array(
	array('label'=>'新私信', 'url'=>array('create')),
	array('label'=>'收件箱', 'url'=>array('inbox')),
	array('label'=>'已发送', 'url'=>array('sentbox')),
);
?>

<h1><?php echo $name; ?></h1>

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

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
