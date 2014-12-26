<?php
require_once('config/config.php');
$def_config = new Config();

# Declaring variables
$content = $def_config->templata_content_directory.'/';
$libraries = $def_config->templata_libraries.'/fns/';

# DEFINITIONS :

//define('T_MODEL', 'models/');
define('T_CONTROLLER', 'controllers/');

define('T_CONTENT', $content);
define('T_LIBS', $def_config->templata_libraries.'/');
define('T_SYSTEM', T_LIBS.'system/');
define('T_SYS', T_LIBS.'system/');
define('T_MODELS', T_LIBS.'models/');
define('T_MODEL', T_LIBS.'models/');
define('T_FNS', T_LIBS.'fns/');
define('T_IMAGES', $def_config->templata_images_directory.'/');
define('T_TOOLS', 'tools/');
