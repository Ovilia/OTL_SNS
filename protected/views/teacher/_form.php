<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'teacher-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">带<span class="required">*</span>的为必填项。</p>

	<?php echo $form->errorSummary($model); ?>

	<?php if(!$model->isNewRecord) { ?>
	<div class="row">
		<?php echo $form->labelEx($model,'TID'); ?>
		<?php echo $form->textField($model, 'TID', array('readonly'=>'readonly')); ?>
	</div>
	<?php } ?>

	<div class="row">
		<?php echo $form->labelEx($model,'TEACHER_NAME'); ?>
		<?php echo $form->textField($model,'TEACHER_NAME',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'TEACHER_NAME'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '添加' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
