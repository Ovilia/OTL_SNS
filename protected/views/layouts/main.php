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

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
    <div id="floatHeader">
        <div id="heading-back" class="transparent_class"></div>
        <div id="heading-content">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" style="float: left; margin-right: 20px; " />
            <div class="heading-nav">
                <a href="../" class="selected">Home</a>
            </div>
            <span class="heading-span">|</span>
            <div class="heading-nav">
                <a href="#">Profile</a>
            </div>
            <span class="heading-span">|</span>
            <div class="heading-nav">
                <a href="#">Friend Feeds</a>
            </div>
            <span class="heading-span">|</span>
            <div class="heading-nav">
                <a href="#">Message</a>
            </div>
            <span class="heading-span">|</span>
            <div class="heading-nav">
                <a href="#">Logout</a>
            </div>
            <div class="heading-ava">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/ava.jpeg" />
            </div>
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

</body>
</html>
