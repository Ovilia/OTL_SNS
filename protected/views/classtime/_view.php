<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIMEID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TIMEID), array('view', 'id'=>$data->TIMEID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('START_TIME')); ?>:</b>
	<?php echo CHtml::encode($data->START_TIME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('END_TIME')); ?>:</b>
	<?php echo CHtml::encode($data->END_TIME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DAY_OF_WEEK')); ?>:</b>
	<?php echo CHtml::encode($data->DAY_OF_WEEK); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('WEEK_OF_SEMESTER')); ?>:</b>
	<?php echo CHtml::encode($data->WEEK_OF_SEMESTER); ?>
	<br />


</div>