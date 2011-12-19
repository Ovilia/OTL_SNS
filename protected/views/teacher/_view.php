<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TID), array('view', 'id'=>$data->TID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TEACHER_NAME')); ?>:</b>
	<?php echo CHtml::encode($data->TEACHER_NAME); ?>
	<br />


</div>