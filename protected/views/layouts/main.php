<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/buttons.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/heading.css" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <link href='http://fonts.googleapis.com/css?family=Julee' rel='stylesheet' type='text/css'>

    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
    <div id="floatHeader">
        <div id="heading-back" class="transparent_class"></div>
        <div id="heading-content">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" style="float: left; margin-right: 20px; " />
            <div class="heading-nav">
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/index" class="selected">首页</a>
            </div>
            <span class="heading-span">|</span>
            <div class="heading-nav">
                <a href="#">好友</a>
            </div>
            <span class="heading-span">|</span>
            <div class="heading-nav">
		<?php echo CHtml::link("私信", array("message/inbox")); ?>
            </div>
            <span class="heading-span">|</span>
            <div class="heading-nav">
		<?php echo CHtml::link("课程", array("course/search")); ?>
            </div>
            <span class="heading-span">|</span>
            <div class="heading-nav">
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?logout">登出</a>
            </div>

            <div class="heading-ava">
			<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/updateProfile/<?php echo Yii::app()->user->id; ?>">
                	<?php
                        $this->widget('application.extensions.VGGravatarWidget', array(
                            'email' => Yii::app()->session['email'], // email to display the gravatar belonging to it
                            'hashed' => false, // if the email provided above is already md5 hashed then set this property to true, defaults to false
                            'default' => 'identicon', // if an email is not associated with a gravatar this image will be displayed,
                            // by default this is omitted so the Blue Gravatar icon will be displayed you can also set this to
                            // "identicon" "monsterid" and "wavatar" which are default gravatar icons
                            'size' => 25, // the gravatar icon size in px defaults to 40
                            'rating' => 'PG', // the Gravatar ratings, Can be G, PG, R, X, Defaults to G
                            'htmlOptions' => array( 'alt' => 'Gravatar Icon' ), // Html options that will be appended to the image tag
                        ));
                    ?>
				</a>
            </div>

            <div class="search">
                <form action="" method="post" name="search" id="search">
                    <input name="keyword" type="text" class="input" id="keyword" value="" style="float:left;">
                    <label for="keyword" id="for-keyword" class="label">我要搜索</label>
                    <span class="submit" onclick="return formSubmit('frmsearch');">搜索</span>
                </form>
                <div id="search_suggest">
                    Content of search suggest.
                </div><!-- End of search_suggest -->
            </div><!-- End of search -->
        </div><!-- End of heading-content -->
    </div><!-- End of floatHeader -->

<div class="container" id="page">
	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Team OTL.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->
    
<script type='text/javascript'>
$(document).ready(function(){
    tip('keyword','for-keyword');
    $("#keyword").keyup(function(){
        keywordval=$('#keyword').val();
        if (keywordval == null || keywordval == ''){
            $('#search_suggest').html('');
            return;
        }
        $.ajax({
            type:"POST",
            url:"<?php echo CHtml::normalizeUrl(array('site/search')); ?>",
            data:"ajax='ajax'&name='"+keywordval+"'",
            dataType:"json",
            success:function(result) {
                $("#search_suggest").html("<a href='<?php echo CHtml::normalizeUrl(array('user/search')); ?>?User[USER_NAME]=" + keywordval + "'><div class='search_type'>搜索用户 " + keywordval + "</div></a>");
                for (i in result.users) {
                    $("#search_suggest").append("<div class='search_suggest_result'><a href='<?php echo CHtml::normalizeUrl(array('user/view')); ?>/" + result.users[i].uid + "'>"+result.users[i].username + "</a></div>");
                }
                $("#search_suggest").append("<a href='<?php echo CHtml::normalizeUrl(array('course/search')); ?>?Course[COURSE_NAME]=" + keywordval + "'><div class='search_type'>搜索课程 " + keywordval + "</div></a>");
                for (i in result.courses) {
                    $("#search_suggest").append("<div class='search_suggest_result'>"+result.courses[i].coursename + "</div>");
                }
            }
        });
    });
});
</script>
</body>
</html>
