<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'status-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'UID'); ?>
		<?php echo $form->dropDownList($model, 'UID', GxHtml::listDataEx(::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'UID'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'UPDATE_TIME'); ?>
		<?php echo $form->textField($model, 'UPDATE_TIME'); ?>
		<?php echo $form->error($model,'UPDATE_TIME'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'CONTENT'); ?>
		<?php echo $form->textArea($model, 'CONTENT'); ?>
		<?php echo $form->error($model,'CONTENT'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->