<?php
Class DatabaseConfig
{
    # DB
    public $host, $user_name, $password, $database;

    function __construct()
    {
        if($_SERVER['HTTP_HOST'] == 'localhost') {$this->development();}
        else {$this->production();}
    }

    # Fill in the credentials for your development environment in this function
    private function development()
    {
        $this->host = 'localhost';
        $this->user_name = 'root';
        $this->password = '';
        $this->database = '';
    }

    # Fill in the credentials for the production environment in this function
    private function production()
    {
        $this->host = 'localhost';
        $this->user_name = '';
        $this->password = '';
        $this->database = '';
    }
}

