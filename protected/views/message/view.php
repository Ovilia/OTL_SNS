<?php
$this->pageTitle=Yii::app()->name . ' - 私信';
$this->breadcrumbs=array(
	$model->MID,
);

$this->menu=array(
	array('label'=>'收件箱', 'url'=>array('inbox')),
	array('label'=>'已发送', 'url'=>array('sentbox')),
	array('label'=>'新私信', 'url'=>array('create')),
);
?>

<h1>私信 #<?php echo $model->MID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'MID',
		array(
			'label'=>'发件人',
			'type'=>'raw',
			'value'=>$model->Sender->USER_NAME
		),
		array(
			'label'=>'收件人',
			'type'=>'raw',
			'value'=>$model->Receiver->USER_NAME
		),
		'SEND_TIME',
		'ISREAD',
		'CONTENT',
	),
)); ?>
