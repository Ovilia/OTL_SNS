<?php
$this->pageTitle=Yii::app()->name . ' - 编辑课时';
$this->breadcrumbs=array(
	'返回修改课程安排'=>array('class/update', 'id'=>$model->CID),
	'返回修改已有的课时'=>array('atomclass/admin', 'class_id'=>$model->CID),
);
?>

<h1>编辑课时<?php echo $model->ACID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
