<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'aclass-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'COURSE_CODE'); ?>
		<?php echo $form->textField($model,'COURSE_CODE',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'COURSE_CODE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'YEAR'); ?>
		<?php echo $form->textField($model,'YEAR',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'YEAR'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SEMESTER'); ?>
		<?php echo $form->textField($model,'SEMESTER',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'SEMESTER'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->