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
	                'email' => $this->sidebar['email'], // email to display the gravatar belonging to it
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
                echo $this->sidebar['user_name'];
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
                喂了几口：
                    <?php 
                    $feedAmt = count($this->sidebar['feed']); 
                    echo $feedAmt;
                    ?>
				<div id="side_feed_avatar_panel">
			    	<?php
					for ($i = 0; $i < $feedAmt && $i < 20; ++$i){
                        echo '<a href="' . Yii::app()->request->baseUrl . '/index.php/user/' . $this->sidebar['feed'][$i]['UID'] . '">';
						$this->widget('application.extensions.VGGravatarWidget', array(
			                'email' => $this->sidebar['feed'][$i]['email'], // email to display the gravatar belonging to it
			                'hashed' => false, // if the email provided above is already md5 hashed then set this property to true, defaults to false
			                'default' => 'identicon', // if an email is not associated with a gravatar this image will be displayed,
			                // by default this is omitted so the Blue Gravatar icon will be displayed you can also set this to
			                // "identicon" "monsterid" and "wavatar" which are default gravatar icons
			                'size' => 30, // the gravatar icon size in px defaults to 40
			                'rating' => 'PG', // the Gravatar ratings, Can be G, PG, R, X, Defaults to G
			                'htmlOptions' => array( 'alt' => 'Gravatar Icon' ), // Html options that will be appended to the image tag
						));
                        echo '</a>';
					}
		            ?>
				</div><!-- side_feed_avatar_panel -->
                被喂几口：
                    <?php
                    $fedAmt = count($this->sidebar['fed']);
                    echo $fedAmt;
                    ?>
				<div id="side_befed_avatar_panel">
			    	<?php
					for ($i = 0; $i < $fedAmt && $i < 20; ++$i){
                        echo '<a href="' . Yii::app()->request->baseUrl . '/index.php/user/' . $this->sidebar['fed'][$i]['UID'] . '">';
						$this->widget('application.extensions.VGGravatarWidget', array(
			                'email' => $this->sidebar['fed'][$i]['email'], // email to display the gravatar belonging to it
			                'hashed' => false, // if the email provided above is already md5 hashed then set this property to true, defaults to false
			                'default' => 'identicon', // if an email is not associated with a gravatar this image will be displayed,
			                // by default this is omitted so the Blue Gravatar icon will be displayed you can also set this to
			                // "identicon" "monsterid" and "wavatar" which are default gravatar icons
			                'size' => 30, // the gravatar icon size in px defaults to 40
			                'rating' => 'PG', // the Gravatar ratings, Can be G, PG, R, X, Defaults to G
			                'htmlOptions' => array( 'alt' => 'Gravatar Icon' ), // Html options that will be appended to the image tag
						));
                        echo '</a>';
					}
		            ?>
                    </a>
				</div><!-- side_befed_avatar_panel -->
                一起上课的人：
                    <?php
                    $classmateAmt = count($this->sidebar['classmate']);
                    echo $classmateAmt;
                    ?>
                <div id="side_classmate_avatar_panel">
                    <?php
                    for ($i = 0; $i < $classmateAmt && $i < 20; ++$i){
                        echo '<a href="' . Yii::app()->request->baseUrl . '/index.php/user/' . $this->sidebar['classmate'][$i]['UID'] . '">';
                        $this->widget('application.extensions.VGGravatarWidget', array(
                            'email' => $this->sidebar['classmate'][$i]['email'], // email to display the gravatar belonging to it
                            'hashed' => false, // if the email provided above is already md5 hashed then set this property to true, defaults to false
                            'default' => 'identicon', // if an email is not associated with a gravatar this image will be displayed,
                            // by default this is omitted so the Blue Gravatar icon will be displayed you can also set this to
                            // "identicon" "monsterid" and "wavatar" which are default gravatar icons
                            'size' => 30, // the gravatar icon size in px defaults to 40
                            'rating' => 'PG', // the Gravatar ratings, Can be G, PG, R, X, Defaults to G
                            'htmlOptions' => array( 'alt' => 'Gravatar Icon' ), // Html options that will be appended to the image tag
                        ));
                        echo '</a>';
                    }
                    ?>
                </div><!-- side_classmate_avatar_panel -->
            </div>
		</div><!-- sidebar -->
	</div>
</div>
<?php $this->endContent(); ?>
