<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'classtime-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">带<span class="required">*</span>的为必填项。</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'START_TIME'); ?>
		<?php echo $form->textField($model,'START_TIME'); ?>
		<?php echo $form->error($model,'START_TIME'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'END_TIME'); ?>
		<?php echo $form->textField($model,'END_TIME'); ?>
		<?php echo $form->error($model,'END_TIME'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DAY_OF_WEEK'); ?>
		<?php echo $form->textField($model,'DAY_OF_WEEK'); ?>
		<?php echo $form->error($model,'DAY_OF_WEEK'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'WEEK_OF_SEMESTER'); ?>
		<?php echo $form->textField($model,'WEEK_OF_SEMESTER'); ?>
		<?php echo $form->error($model,'WEEK_OF_SEMESTER'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '添加' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
