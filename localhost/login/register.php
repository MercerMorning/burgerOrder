<?php
require_once "init.php";
if (isUserAuthorized()) {
    header("Location: index.php");
    die();
}

$name = $_POST["login"];
$originalPassword = $_POST["password"];
$password = getPasswordHash($originalPassword);

if (getUserByLogin($name)) {
    echo "Already user the same name exists";
    die();
}

$query = "INSERT INTO blog (`name`, `password`, email) VALUES ('$name', '$password', 'example@mail.ru')";
$ret = getDbConnection()->query($query);

if ($ret) {
    echo "User created succesfully";
} else {
    var_dump(getDbConnection()->errorInfo());
    echo "error";
}
?>