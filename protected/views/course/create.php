<?php
$this->pageTitle=Yii::app()->name . ' - 添加课程';
$this->renderPartial('_menu');
?>

<h1>添加新课程</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
