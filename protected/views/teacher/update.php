<?php
$this->pageTitle=Yii::app()->name . ' - 编辑教师信息';
$this->renderPartial('_menu');
$this->breadcrumbs=array(
	"返回浏览教师信息"=>array('teacher/admin', 'class_id'=>$class_id),
);

?>

<h1>编辑教师#<?php echo $model->TID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
