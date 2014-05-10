<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('config.php');
require_once('libs/fns/placeholders.php');

$config = new Config();
$edit = new PlaceholderManager();

$content = 'CSS path: {templata:css}' . "<br>";
$content .= 'Images path: {templata:images}' . "<br>";
$content .= 'JQuery path: {templata:jquery}' . "<br>";
$content .= 'Template CSS: {template:css}' . "<br>";
$content .= 'Template JS: {template:js:jquery}' . "<br>";

$x = $edit->templata_placeholders($content);

echo $x;

//var_dump($config->active_template);