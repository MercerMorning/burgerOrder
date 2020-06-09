<?php
require_once "init.php";
if (isUserAuthorized()) {
    header("Location: index.php");
    die();
}
?>
Register:<br>
<form action="register.php" method="post">
    Login<input type="text" name="login" value=""><br>
    Password <input type="text" name="password" value=""><br>
    <input type="submit" value="Register">
</form>

<br>
Auth
<form action="auth.php" method="post">
    Login<input type="text" name="login" value=""><br>
    Password <input type="text" name="password" value=""><br>
    <input type="submit" value="Login">
</form>
