<?php
require_once "init.php";

if (!isUserAuthorized()) {
    header("Location: registerForm.php");
    die();
}

$db = getDbConnection();

$message = $_POST["message"];
$userId = $_SESSION["user_id"];
$date = date("Y-m-d H:i:s");

$query = "INSERT INTO posts (user_id, message,`datetime`) VALUES ('$userId', :placeholder, '$date')";

$prepared = $db->prepare($query);
$ret = $prepared->execute(["placeholder" => $message]);

$postId = $db->lastInsertId();
if (!empty($_FILES["userfile"]["tmp_name"])) {
    $fileContent = file_get_contents($_FILES["userfile"]["tmp_name"]);
    file_put_contents("../../images/" . $postId . ".jpg", $fileContent);
}



if (!$ret) {
    print_r($db->errorInfo());
    echo "error";
    die();
}

header("Location: index.php");