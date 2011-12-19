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
// Classmate
$classmateData = array();
$classmateAmt = count($classmate);
for ($i = 0; $i < $classmateAmt; ++$i){
    $classmateData[$i]['UID'] = $classmate[$i]->UID;
    $classmateData[$i]['email'] = User::model()->findByPk($classmate[$i]->UID)->EMAIL;
}

$this->sidebar=array(
	'fed'=>$fed,
	'feed'=>$feed,
    'classmate'=>$classmateData,
    'recentStatus'=> $recentStatus == null ? 'ta很懒，什么都没说' : $recentStatus[0]->CONTENT,
	'UID'=>$model->UID,
	'email'=>$model->EMAIL,
	'user_name'=>$model->USER_NAME,
);
?>

<h1>我的首页</h1>
<div>
    <form>
        <textarea name="contents" id="statusContent" placeholder="说点什么吧..."></textarea>
        <?php echo CHtml::button('发状态', array('submit'=>array('status/publish'),
            'class'=>'button medium green')); ?>
    </form>
    <div class="search_suggest" id="status_search_suggest">
       Content of search suggest.
    </div>
    <script type='text/javascript'>
    $(document).ready(function(){
        $("#statusContent").focus(function(){
            $("#status_search_suggest").slideDown();
            if ($("#statusContent").val() == null ||
                $("#statusContent").val() == ''){
                $("#status_search_suggest").html('');
                return;
            }
            // If current is 
        });
        $("#statusContent").blur(function(){
            $("#status_search_suggest").slideUp();
        });
    });
    </script>
    
</div><!-- status-form -->

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
