<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('MID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->MID), array('view', 'id'=>$data->MID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UID')); ?>:</b>
	<?php echo CHtml::encode($data->UID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USE_UID')); ?>:</b>
	<?php echo CHtml::encode($data->USE_UID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SEND_TIME')); ?>:</b>
	<?php echo CHtml::encode($data->SEND_TIME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ISREAD')); ?>:</b>
	<?php echo CHtml::encode($data->ISREAD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONTENT')); ?>:</b>
	<?php echo CHtml::encode($data->CONTENT); ?>
	<br />


</div>