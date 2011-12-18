<h2>新增课程安排</h2>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'class-arrangement-form',
	'action'=>CHtml::normalizeUrl(array('addAtomClass')),
	'enableAjaxValidation'=>false,
)); ?>
	<div class="row">
		时间：
		<?php echo "第" . CHtml::textField(
			'week', '', array(
				'size'=>2, 'maxlength'=>2
			)
		) . "周"; ?> 
		<?php echo CHtml::dropDownList(
			'day', '', Classtime::model()->getDayOfWeekOptions()
		); ?>
		<?php echo CHtml::dropDownList(
			'duration', '', Classtime::model()->getClassDurationOptions()
		); ?>
	</div>
	<div class="row">
		地点：
		<?php echo "教学楼号：" . CHtml::textField(
			'building', '', array(
				'size'=>2, 'maxlength'=>2
			)
		) . "教室号：" . CHtml::textField(
			'classroom', '', array(
				'size'=>4, 'maxlength'=>4
			)
		); ?>
	</div>
	<div class="row button">
		<?php echo CHtml::submitButton("新增"); ?>
	</div>
<?php $this->endWidget(); ?>

<h2>已有课程安排</h2>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'summaryText'=>'这门课的共有{count}次课，下面显示{start}-{end}次的课程安排:',
	'dataProvider'=>$atomclasses,
	'columns'=>array(
		array(
			'type'=>'raw',
			'name'=>'上课时间',
			'value'=>'$data->classTimeToString()',
		),
		array(
			'type'=>'raw',
			'name'=>'上课地点',
			'value'=>'$data->classLocationToString()',
		),
	),
)); ?>
