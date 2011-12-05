<?php
$this->sidebar=array(
    'feedAmt'=>12,
    'beFedAmt'=>3,
    'recentStatus'=>'This is Ovilia\'s recent status.'
);
?>

<h1>Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
