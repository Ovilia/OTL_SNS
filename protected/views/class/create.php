<?php
$this->pageTitle=Yii::app()->name . ' - 添加课程安排';
$this->renderPartial('_menu');
?>

<h1>添加课程安排</h1>
<p>你将添加如下的课程安排：</p>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
