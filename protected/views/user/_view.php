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
    ?>
    
    <?php echo CHtml::link(CHtml::encode(User::model()->findByPk($data->UID)->USER_NAME), array('view', 'id' => $data->UID)); ?>
    ：
	<?php 
	    $output = '';
        $raw = $data->CONTENT;
        $pos = strpos($raw, '#');
        while ($pos !== false) {
            $output .= substr($raw, 0, $pos);
            $raw = substr($raw, $pos);
            $pos = strpos($raw, ' ');
            $course = substr($raw, 0, $pos);
            $raw = substr($raw, $pos + 1);
            $cid = substr($raw, 0, strpos($raw, ' '));
            $output .= "<a href='".CHtml::normalizeUrl(array('class/view'))."/".$cid."'>".$course."</a>";
            $raw = substr($raw, strpos($raw, ' '));
            $pos = strpos($raw, '#');
        }
        echo $output.$raw;
	?>
    <div class="status_time">
        <?php echo CHtml::encode($data->UPDATE_TIME); ?>
    </div>
    <br>
    <?php echo CHtml::button('回复',array('class'=>'button small gray comment-button', 'id'=>$data->SID)); ?>
    <div class="comment-form" style="display:none" id="form<?php echo $data->SID ?>">
        <input id="comment<?php echo $data->SID ?>">
        <?php echo CHtml::button('确认',array('class'=>'button small green submit-button', 'id'=>'button'.$data->SID, 'onclick'=>'submitComment('.$data->SID.')')); ?>
    </div><!-- comment-form -->
    <button class="button small gray show-comment-button" type="button" id="show<?php echo CHtml::encode($data->SID); ?>">查看评论</button>
    <div style="display:none" id="comments<?php echo $data->SID ?>">
        <?php
            foreach ($data->comments as $acomment) {
                $commentUser = $acomment->user;
			    echo "<p> $commentUser->USER_NAME : $acomment->CONTENT </p>";
			}
	    ?>
	</div>
</div>
