<div class="view">
    <?php
        $this->widget('application.extensions.VGGravatarWidget', array(
            'email' => User::model()->findByPk($data->UID)->EMAIL, // email to display the gravatar belonging to it
            'hashed' => false, // if the email provided above is already md5 hashed then set this property to true, defaults to false
            'default' => 'identicon', // if an email is not associated with a gravatar this image will be displayed,
            // by default this is omitted so the Blue Gravatar icon will be displayed you can also set this to
            // "identicon" "monsterid" and "wavatar" which are default gravatar icons
            'size' => 35, // the gravatar icon size in px defaults to 40
            'rating' => 'PG', // the Gravatar ratings, Can be G, PG, R, X, Defaults to G
            'htmlOptions' => array( 'alt' => 'Gravatar Icon' ), // Html options that will be appended to the image tag
        ));
        Yii::app()->clientScript->registerScript('comment', "
        $('.comment-button').click(function(){
            formID = '#form' + this.id;
        	$(formID).toggle();
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
                        else if (result == 0)
                            alert("You have rated this class");
                        else
                            alert("You haven't take this class.");
                    }
                });
            	return false;
            }
    </script>
    <?php echo CHtml::link(CHtml::encode(User::model()->findByPk($data->UID)->USER_NAME), array('view', 'id' => $data->UID)); ?>
    ：
	<?php echo CHtml::encode($data->CONTENT); ?>
    <div class="status_time">
        <?php echo CHtml::encode($data->UPDATE_TIME); ?>
    </div>
    <br>
    <?php echo CHtml::button('回复',array('class'=>'button small gray comment-button', 'id'=>$data->SID)); ?>
    <div class="comment-form" style="display:none" id="form<?php echo $data->SID ?>">
        <input id="comment<?php echo $data->SID ?>">
        <?php echo CHtml::button('确认',array('class'=>'button small green submit-button', 'id'=>'button'.$data->SID, 'onclick'=>'submitComment('.$data->SID.')')); ?>
    </div><!-- comment-form -->
    <button class="button small gray" type="button" onclick="show_comment(<?php echo CHtml::encode($data->SID); ?>)">查看评论</button>

</div>
