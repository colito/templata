<?php
require_once('libs/fns/placeholders.php');

$edit = new PlaceholderManager();

$content = 'CSS path: {templata:css}' . "\n";
$content .= 'Images path: {templata:images}' . "\n";
$content .= 'JQuery path: {templata:jquery}' . "\n";
$content .= 'Template resource: {template-res:js}' . "\n";

$x = $edit->templata_placeholders($content, 'Placeholder Test Page', '../');

var_dump($x);

//echo $content;

//var_dump($content);