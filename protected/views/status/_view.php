<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('SID')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->SID), array('view', 'id' => $data->SID)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('UID')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('UPDATE_TIME')); ?>:
	<?php echo GxHtml::encode($data->UPDATE_TIME); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('CONTENT')); ?>:
	<?php echo GxHtml::encode($data->CONTENT); ?>
	<br />

</div>