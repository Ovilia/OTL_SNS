<?php
$this->pageTitle=Yii::app()->name . ' - 新私信';

$this->menu=array(
	array('label'=>'收件箱', 'url'=>array('inbox')),
	array('label'=>'已发送', 'url'=>array('sentbox')),
);
?>

<h1>新私信</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
