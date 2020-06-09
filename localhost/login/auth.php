<?php
require_once "init.php";
if (isUserAuthorized()) {
    header("Location: index.php");
    die();
}

$login = $_POST["login"];
$user = getUserByLogin($login);
if (!$user) {
    echo "No user with this login and password";
    die();
}

$gotPassword = $_POST["password"];
$passwordHash = getPasswordHash($gotPassword);

if ($passwordHash !== $user["password"]) { //Почему здесь такое сравнение
    echo "No user with this login and password";
    die();
}

$_SESSION["user_id"] = $user["id"];
header("Location: index.php?authorized=1");