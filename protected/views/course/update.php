<?php
$this->pageTitle=Yii::app()->name . ' - 更新课程';
$this->renderPartial('_menu');
?>

<h1>更新课程</h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<div id="classes-form">
<h2>该课程可供选择的课程安排如下:</h2>
<?php echo $this->renderPartial('_list', array('classes'=>$classes)); ?>
</div>
