<?php use kartik\growl\Growl;

echo Growl::widget([
	'type' => Growl::TYPE_SUCCESS,
	'icon' => 'glyphicon glyphicon-ok-sign',
	'title' => 'Note',
	'showSeparator' => true,
	'body' => 'This is a successful growling alert.'
]);
    ?> 
