<?php $this->widget('zii.widgets.grid.CGridView', array(
	'summaryText'=>'共有{count}个结果，下面显示{start}-{end}个:',
	'dataProvider'=>$classes,
	'columns'=>CourseColumns::listColumns(),
)); ?>
