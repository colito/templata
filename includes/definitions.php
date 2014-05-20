<?php
require_once('config.php');
$def_config = new Config();

# Declaring variables
$content = $def_config->templata_content_directory.'/';
$libraries = $def_config->templata_libraries.'/fns/';

# DEFINITIONS :

define('T_CONTENT', $content);
define('T_FNS', $def_config->templata_libraries.'/fns/');
define('T_IMAGES', $def_config->templata_images_directory.'/');
define('T_TOOLS', 'tools/');
