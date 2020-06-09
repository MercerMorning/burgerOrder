<?php
session_start();

require_once "functions.php";

function getDbConnection(): PDO
{
    static $DB;
    if (!$DB) {
        try {
            $DB = new PDO("mysql:host=localhost;dbname=users_bd", "root", "root");
        } catch (Exception $e) {
            die('error' . $e->getMessage());
        }
    }

    return $DB;
}
