<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div class="span-15">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<div class="span-9 last">
		<div id="sidebar">
            <div id="side_avatar">
			    <?php
	            $this->widget('application.extensions.VGGravatarWidget', array(
	                'email' => Yii::app()->session['email'], // email to display the gravatar belonging to it
	                'hashed' => false, // if the email provided above is already md5 hashed then set this property to true, defaults to false
	                'default' => 'identicon', // if an email is not associated with a gravatar this image will be displayed,
	                // by default this is omitted so the Blue Gravatar icon will be displayed you can also set this to
	                // "identicon" "monsterid" and "wavatar" which are default gravatar icons
	                'size' => 50, // the gravatar icon size in px defaults to 40
	                'rating' => 'PG', // the Gravatar ratings, Can be G, PG, R, X, Defaults to G
	                'htmlOptions' => array( 'alt' => 'Gravatar Icon' ), // Html options that will be appended to the image tag
				));
	            ?>
            </div><!-- avatar -->
            <div id="side_username">
                <?php
                echo Yii::app()->session['username'];
                ?>
            </div>
			<div id="side_status">
				<br><br>
				<?php
				echo $this->sidebar['recentStatus'];
				?>
			</div>
            <hr>
            <div id="side_feed">
                喂了几口：<?php echo $this->sidebar['feedAmt']; ?>
				<div id="side_feed_avatar_panel">
			    	<?php
					for ($i = 0; $i < $this->sidebar['feedAmt'] && $i < 20; ++$i){
						$this->widget('application.extensions.VGGravatarWidget', array(
			                'email' => $i, // email to display the gravatar belonging to it
			                'hashed' => false, // if the email provided above is already md5 hashed then set this property to true, defaults to false
			                'default' => 'identicon', // if an email is not associated with a gravatar this image will be displayed,
			                // by default this is omitted so the Blue Gravatar icon will be displayed you can also set this to
			                // "identicon" "monsterid" and "wavatar" which are default gravatar icons
			                'size' => 30, // the gravatar icon size in px defaults to 40
			                'rating' => 'PG', // the Gravatar ratings, Can be G, PG, R, X, Defaults to G
			                'htmlOptions' => array( 'alt' => 'Gravatar Icon' ), // Html options that will be appended to the image tag
						));
					}
		            ?>
				</div><!-- side_feed_avatar_panel -->
                被喂几口：<?php echo $this->sidebar['beFedAmt']; ?>
				<div id="side_befed_avatar_panel">
			    	<?php
					for ($i = 0; $i < $this->sidebar['beFedAmt'] && $i < 20; ++$i){
						$this->widget('application.extensions.VGGravatarWidget', array(
			                'email' => $i . 'email', // email to display the gravatar belonging to it
			                'hashed' => false, // if the email provided above is already md5 hashed then set this property to true, defaults to false
			                'default' => 'identicon', // if an email is not associated with a gravatar this image will be displayed,
			                // by default this is omitted so the Blue Gravatar icon will be displayed you can also set this to
			                // "identicon" "monsterid" and "wavatar" which are default gravatar icons
			                'size' => 30, // the gravatar icon size in px defaults to 40
			                'rating' => 'PG', // the Gravatar ratings, Can be G, PG, R, X, Defaults to G
			                'htmlOptions' => array( 'alt' => 'Gravatar Icon' ), // Html options that will be appended to the image tag
						));
					}
		            ?>
				</div><!-- side_befed_avatar_panel -->
            </div>
		</div><!-- sidebar -->
	</div>
</div>
<?php $this->endContent(); ?>
