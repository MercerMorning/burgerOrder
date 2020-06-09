<?php
function isUserAuthorized(): bool
{
    return isset($_SESSION["user_id"]);
}

function getPasswordHash(string $userPassword): string
{
    return sha1($userPassword . "qwerty");
}

function getUserByLogin($login): array
{
    $query = "SELECT * FROM blog WHERE `name` = '$login' LIMIT 1";
    $ret = getDbConnection()->query($query);
    $users = $ret->fetchAll();
    return !empty($users[0]) ? $users[0] : [];
}