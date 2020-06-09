<?php
require_once "init.php";

if (!isUserAuthorized()) {
    header("Location: registerForm.php");
    die();
}

echo "Пользователь авторитизован", "<br>";

if (!empty($_GET["authorized"])) {
    echo "You ve just registered";
}

include "postForm.php";
echo "<br>";
include "blog.php";