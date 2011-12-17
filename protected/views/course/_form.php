<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'course-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">带<span class="required">*</span>为必填项。</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'COURSE_CODE'); ?>
		<?php echo $form->textField($model,'COURSE_CODE',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'COURSE_CODE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COURSE_NAME'); ?>
		<?php echo $form->textField($model,'COURSE_NAME',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'YEAR'); ?>
		<?php echo $form->textField($model,'YEAR',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'YEAR'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SEMESTER'); ?>
		<?php echo $form->textField($model,'SEMESTER',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'SEMESTER'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '添加' : '更新'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
