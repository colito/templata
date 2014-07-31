<?php

$json_file = file_get_contents('json_scripts/locations.json');
$json_file2 = file_get_contents('json_scripts/people.json');

$json['locations'] = json_decode($json_file);
$json['people'] = json_decode($json_file2);

var_dump($json);

