<?php

class Config
{
    public $user_name = 'admin_dunamis';
    public $user_pword= 'KEmohae';

    public function file_root()
    {
        $root = $_SERVER['DOCUMENT_ROOT'].'/emp/';
        return $root;
    }
}

?>