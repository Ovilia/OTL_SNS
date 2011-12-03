<?php
$this->breadcrumbs=array(
	'Users',
);

$this->menu=array(
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>Users</h1>

<?php
$this->widget('application.extensions.VGGravatarWidget', array(
    'email' => Yii::app()->session['email'], // email to display the gravatar belonging to it
    'hashed' => false, // if the email provided above is already md5 hashed then set this property to true, defaults to false
    'default' => 'identicon', // if an email is not associated with a gravatar this image will be displayed,
    // by default this is omitted so the Blue Gravatar icon will be displayed you can also set this to
    // "identicon" "monsterid" and "wavatar" which are default gravatar icons
    'size' => 80, // the gravatar icon size in px defaults to 40
    'rating' => 'PG', // the Gravatar ratings, Can be G, PG, R, X, Defaults to G
    'htmlOptions' => array( 'alt' => 'Gravatar Icon' ), // Html options that will be appended to the image tag
));
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
