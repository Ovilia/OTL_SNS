<?php
$menu=array(
	array('label'=>'查找课程', 'url'=>array('search')),
);

if (Yii::app()->user->role==="admin")
{
	array_push($menu, array('label'=>'创建课程', 'url'=>array('create')));
}

$this->menu=$menu;
?>
