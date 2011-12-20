<?php
// initial the columns for the CGridView
$columns = array(
	'CID',
	array(
		'type'=>'raw',
		'name'=>'课程安排',
		'value'=>'$data->classAtomClassesToString()',
	),
	array(
		'type'=>'raw',
		'name'=>'任课教师',
		'value'=>'$data->teachersToString()',
	),
	array(
		'class'=>'CLinkColumn',
		'label'=>'浏览',
		'urlExpression'=>'CHtml::normalizeUrl(array(
				"class/view",
				"id"=>$data->CID,
				))',
	),
);
if (Yii::app()->user->role==="admin")
{
	$column=array(
		'class'=>'CButtonColumn',
		'template'=>'{edit}{delete}',
		'buttons'=>array(
			'edit'=>array(
				'label'=>' 编辑 ',
				'url'=>'array("class/update", "id"=>$data->CID)',
			),
			'delete'=>array(
				'label'=>' 删除 ',
				'imageUrl'=>false,
				'url'=>'array("class/delete", "id"=>$data->CID)',
			),
		),
	);
	array_push($columns, $column);
}
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
			'summaryText'=>'共有{count}个结果，下面显示{start}-{end}个:',
			'dataProvider'=>$classes,
			'columns'=>$columns,
			)); ?>
