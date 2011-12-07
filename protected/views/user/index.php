<?php
$recentStatus = $dataProvider->getData();
$fed = array();
for ($i = 0; $i < count($fedUser); ++$i){
	$fed[$i] = User::model()->findByPk($fedUser[$i]->USE_UID)->EMAIL;
}
$feed = array();
for ($i = 0; $i < count($feedUser); ++$i){
	$feed[$i] = User::model()->findByPk($feedUser[$i]->UID)->EMAIL;
}
$this->sidebar=array(
    'feedAmt'=>count($fedUser),
	'fed'=>$fed,
    'beFedAmt'=>count($feedUser),
	'feed'=>$feed,
    'recentStatus'=>$recentStatus[0]->CONTENT,
);
?>

<h1>Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
