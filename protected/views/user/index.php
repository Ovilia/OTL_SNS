<?php
// Status
$recentStatus = $dataProvider->getData();
// Be fed
$fed = array();
$fedAmt = count($fedUser);
for ($i = 0; $i < $fedAmt; ++$i){
    $fed[$i]['UID'] = $fedUser[$i]->FEEDER_ID;
	$fed[$i]['email'] = User::model()->findByPk($fedUser[$i]->FEEDER_ID)->EMAIL;
}
// Feed
$feed = array();
$feedAmt = count($feedUser);
for ($i = 0; $i < $feedAmt; ++$i){
    $feed[$i]['UID'] = $feedUser[$i]->FED_ID;
	$feed[$i]['email'] = User::model()->findByPk($feedUser[$i]->FED_ID)->EMAIL;
}
$this->sidebar=array(
	'fed'=>$fed,
	'feed'=>$feed,
    'recentStatus'=> $recentStatus == null ? 'ta很懒，什么都没说' : $recentStatus[0]->CONTENT,
	'UID'=>$model->UID,
	'email'=>$model->EMAIL,
	'user_name'=>$model->USER_NAME,
);
?>

<h1>我的首页</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
