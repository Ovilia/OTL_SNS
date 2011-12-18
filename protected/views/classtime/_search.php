<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'TIMEID'); ?>
		<?php echo $form->textField($model,'TIMEID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'START_TIME'); ?>
		<?php echo $form->textField($model,'START_TIME'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'END_TIME'); ?>
		<?php echo $form->textField($model,'END_TIME'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DAY_OF_WEEK'); ?>
		<?php echo $form->textField($model,'DAY_OF_WEEK'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'WEEK_OF_SEMESTER'); ?>
		<?php echo $form->textField($model,'WEEK_OF_SEMESTER'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->