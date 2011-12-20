<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($time,'WEEK_OF_SEMESTER'); ?>
		<?php echo $form->textField($time,'WEEK_OF_SEMESTER'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($time,'DAY_OF_WEEK'); ?>
		<?php echo $form->textField($time,'DAY_OF_WEEK'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($time,'START_TIME'); ?>
		<?php echo $form->textField($time,'START_TIME'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($time,'END_TIME'); ?>
		<?php echo $form->textField($time,'END_TIME'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'BUILDING_NUMBER'); ?>
		<?php echo $form->textField($model,'BUILDING_NUMBER'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CLASSROOM'); ?>
		<?php echo $form->textField($model,'CLASSROOM',array('size'=>8,'maxlength'=>8)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('搜索'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
