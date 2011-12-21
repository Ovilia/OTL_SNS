<?php
$menu=array(
	array('label'=>'查找用户', 'url'=>array('search')),
);

if (Yii::app()->user->role==="admin")
{
	array_push($menu, array('label'=>'创建用户', 'url'=>array('create')));
}

$this->menu=$menu;
?>
