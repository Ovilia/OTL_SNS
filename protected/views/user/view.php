<?php
/**
 * This piece of code is copied from index.php which may be written by Ovilia,
 * please remove it once the static siderbars becoming dynamic.
 * -- lastland
 */
$this->sidebar=array(
    'feedAmt'=>12,
    'beFedAmt'=>3,
    'recentStatus'=>'This is Ovilia\'s recent status.'
);

?>
<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->UID,
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->UID)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->UID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
    array('label'=>'Feed User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('feed', 'uid'=>$model->UID),'confirm'=>'Are you sure you want to feed this guy?')),
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

<h1>View User #<?php echo $model->UID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'UID',
		'USER_NAME',
		'EMAIL',
		'PASSWORD',
		'REGISTER_TIME',
		'ISADMIN',
	),
)); ?>

<?php
// send an message to this user
echo CHtml::button('发送私信', array(
	'submit'=>array('message/create', 'id'=>$model->UID)
	),
);
?>
