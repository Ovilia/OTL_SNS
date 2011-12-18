<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'aclass-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'COURSE_CODE'); ?>
		<?php echo $form->textField($model,'COURSE_CODE',array(
			'size'=>16, 'maxlength'=>16, 'readonly'=>'readonly'
		)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'YEAR'); ?>
		<?php echo $form->textField($model,'YEAR',array(
			'size'=>4, 'maxlength'=>4, 'readonly'=>'readonly'
		)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SEMESTER'); ?>
		<?php echo $form->textField($model,'SEMESTER',array(
			'size'=>4, 'maxlength'=>4, 'readonly'=>'readonly'
		)); ?>
	</div>

	<div class="row">
		<?php echo CHtml::label("任课教师", false); ?>
		<?php echo CHtml::textField("任课教师", $model->teachersToString(), array(
			'size'=>16, 'maxlength'=>16 
		)); ?>
	</div>

	<div id="row">
		<?php echo $this->renderPartial('_list', array(
			'atomclasses'=>$atomclasses,
		)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton("保存"); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
