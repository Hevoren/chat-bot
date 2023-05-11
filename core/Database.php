<?php

class Database
{
    private $link = null;

    public function __construct($host, $user, $password, $db)
    {
        $this->link = mysqli_connect($host, $user, $password, $db);
        if (mysqli_connect_errno()) {
            echo "Соединение не удалось: " . mysqli_connect_error();
            die();
        }
    }
}