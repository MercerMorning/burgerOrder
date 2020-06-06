<?php
include "config.php";
function main($email)
{
    if (!emailValidation($email)) {
        return ["errors" => "Некорректный email"];
    }
    $pdo = databaseConnect();
    $user = getUser($pdo, $email);
    if (empty($user["id"])) {
        addUser($pdo, $email);
        $user = getUser($pdo, $email);
    }
    addOrder($pdo, $user["id"]);
    return ["result" => $user];
}

/**
 * Валидация email
 * @param $email
 * @return bool
 */
function emailValidation($email)
{
    $mask = '/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]
    {1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u';
    $isAlreadyExistedEmail = "";
     if (preg_match($mask, $email)) {
        return true;
    }
    return false;
}

/**
 * Соединение с базой данных
 * @return PDO
 */
function databaseConnect()
{
    return new PDO(DSN_DB, USERNAME_DB, PASSWORD_DB);
}

/**
 * Запрос пользователя по email
 * @param $email
 * @param $pdo
 * @return bool
 */
function getUser($pdo, $email)
{
    $sql = "SELECT * FROM `users` WHERE `email` = :user_email";
    $statement = $pdo->prepare($sql);
    $statement->execute(["user_email" => strtolower($email)]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

/**
 * Добавление нового пользователя в базу
 * @param $pdo
 * @param $email
 */
function addUser($pdo, $email)
{
    $sql = "INSERT INTO `users` (`email`, `order_count`) VALUES (:user_email, 0)";
    $statement = $pdo->prepare($sql);
    $statement->execute(["user_email" => $email]);
}

/**
 * Добавление новго заказа в базу
 * @param $pdo
 * @param $userId
 */
function addOrder($pdo, $userId)
{
    $sql = "UPDATE `users` SET `order_count` = `order_count`+1 WHERE `id`=:user_id";
    $statement = $pdo->prepare($sql);
    $statement->execute(["user_id" => $userId]);
}





