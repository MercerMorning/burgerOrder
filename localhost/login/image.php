<?php
//почему не вижу картинку
header("Content-type: image/jpg");
$fileId = (int)$_GET["id"];
$data = file_get_contents("../../images/" . $fileId . ".jpg");
echo $data;