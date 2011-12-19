<?php
class CourseColumns
{
	const ADMIN="admin";

	public function listColumns()
	{
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
		if (Yii::app()->user->role===self::ADMIN)
		{
			$column=array(
				'class'=>'CLinkColumn',
				'label'=>'编辑',
				'urlExpression'=>'CHtml::normalizeUrl(array(
						"class/update",
						"id"=>$data->CID,
						))',
			);
			array_push($columns, $column);
		}
		return $columns;
	}
}
?>
