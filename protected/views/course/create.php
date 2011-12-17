<?php

$this->menu=array(
	array('label'=>'查找课程', 'url'=>array('search')),
);
?>

<h1>添加新课程</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
