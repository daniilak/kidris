<?php
class DataBase
{

    public $dbStream; 

    public function __construct()
    {
        try {
            $this->dbStream = new PDO("mysql:host={$GLOBALS['database_host']};dbname={$GLOBALS['database_name']};charset=UTF8", $GLOBALS['database_user'], $GLOBALS['database_password']);
            $this->dbStream->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            trigger_error("Ошибка при подключении к базе данных: {$error}");
        }
    }

}