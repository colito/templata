<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


# Ref: http://stackoverflow.com/questions/4343596/parsing-json-file-with-php
$json = <<< JSON
{
    "John": {
        "status":"Wait",
        "Marrired?": {
            "Yes": {
                "Wife":"Nolu",
                "Husband":"None"
            },
            "No":"False"
        }
    },
    "Jennifer": {
        "status":"Active"
    },
    "James": {
        "status":"Active",
        "age":56,
        "count":10,
        "progress":0.0029857,
        "bad":0
    }
}
JSON;

$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($json, TRUE)),
    RecursiveIteratorIterator::SELF_FIRST);

$jsonIterator_array = array();

foreach ($jsonIterator as $key => $val) {
    if(is_array($val)) {
        //echo "$key: <br>";
        $jsonIterator_array[] = $key;
    } else {
        //echo "$key => $val <br>";
        $jsonIterator_array[$key] = $val;
    }
}

var_dump($jsonIterator_array);

foreach ($jsonIterator as $key => $val) {
    if(is_array($val)) {
        echo "$key: <br>";
    } else {
        echo "$key => $val <br>";
    }
}