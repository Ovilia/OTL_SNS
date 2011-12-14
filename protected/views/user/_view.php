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
	<?php echo CHtml::encode($data->CONTENT); ?>
    <div class="status_time">
        <?php echo CHtml::encode($data->UPDATE_TIME); ?>
    </div>
    <br>
    <button class="button small gray" type="button" onclick="comment(<?php echo CHtml::encode($data->SID); ?>)">回复</button>
    <button class="button small gray" type="button" onclick="show_comment(<?php echo CHtml::encode($data->SID); ?>)">查看评论</button>

</div>
