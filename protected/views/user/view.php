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
    'recentStatus'=>$recentStatus == null ? 'ta很懒，什么都没说' : $recentStatus[0]->CONTENT,
	'UID'=>$model->UID,
	'email'=>$model->EMAIL,
	'user_name'=>$model->USER_NAME,
);
?>

<?php
// Display all flash messages.
$flashMessages = Yii::app()->user->getFlashes();
if ($flashMessages) {
	echo '<ul class="flashes">';
	foreach($flashMessages as $key => $message) {
		echo '<li><div class="flash-' . $key . '">' . $message . "</div></li>\n";
	}
	echo '</ul>';
}
?>

<?php
// An animation for displaying flash messages.
Yii::app()->clientScript->registerScript(
	'flashMsgHideEffect',
	'$(".flashes").animate({opacity: 1.0}, 3000).fadeOut("slow");',
	CClientScript::POS_READY
);
?>

<h1><?php echo $model->USER_NAME; ?>的主页</h1>

<?php

// One can't feed or send message to himself
if ($model->UID != Yii::app()->user->id){
    // send an message to this user
    echo CHtml::button('发送私信', array(
	    'submit'=>array('message/create', 'id'=>$model->UID),
        'class'=>'button green medium'
	));

    // Check if is already fed
    $iFeedHim = Feeds::model()->find("FED_ID = $model->UID AND FEEDER_ID = " . Yii::app()->user->id);
    $heFeedsMe = Feeds::model()->find("FEEDER_ID = $model->UID AND FED_ID = " . Yii::app()->user->id);
    if ($heFeedsMe){
        echo CHtml::button('ta的课程', array(
                    'submit'=>array('user/takes', 'uid'=>$model->UID),
                    'class'=>'button green medium'
        ));
    }
    if ($iFeedHim){
        echo CHtml::button('饿一下', array(
                    'submit'=>array('user/unfeed', 'uid'=>$model->UID),
                    'class'=>'button gray medium'
        ));
    }else{
        echo CHtml::button('喂一下', array(
	                'submit'=>array('user/feed', 'uid'=>$model->UID),
                    'class'=>'button green medium'
	    ));
    }
}

Yii::app()->clientScript->registerScript('comment', "
    $('.comment-button').click(function(){
        formID = '#form' + this.id;
    	$(formID).toggle();
    	return false;
    });
");

Yii::app()->clientScript->registerScript('showComment', "
    $('.show-comment-button').click(function(){
        commentsID = '#comments' + this.id.substr(4);
    	$(commentsID).toggle();
    	return false;
    });
");
?>

<script type='text/javascript'>
    function submitComment(id){
            var commentID='#comment' + id;
    	    var contents=$(commentID).val();
        	$('#form' + id).toggle();
        	$.ajax({
                type:"POST",
                url:"<?php echo CHtml::normalizeUrl(array('status/comment')); ?>",
                data:"ajax='ajax'&sid="+id+"&content="+contents,
                dataType:"json",
                success:function(result) {
                    if (result == 1)
                        alert(contents);
                }
            });
        	return false;
        }
</script>
    
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

