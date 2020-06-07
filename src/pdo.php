<?php

namespace App;

class Burger
{
    public function main($email)
    {
        if (!emailValidation($email)) {
            return ["errors" => "Некорректный email"];
        }
        $email = strtolower($email);
        databaseConnect();
        $user = getUser($email);
        if (empty($user["id"])) {
            addUser($email);
            $user = getUser($email);
        }
        addOrder($user["id"]);
        return ["result" => $user];
    }

    /**
     * Валидация email
     * @param $email
     * @return bool
     */
    protected function emailValidation($email)
    {
        return (filter_var($email, FILTER_VALIDATE_EMAIL) !== false);
    }

    /**
     * Соединение с базой данных
     */
    protected function databaseConnect()
    {
        include "config.php";
        global $pdo;
        $pdo = new PDO(DSN_DB, USERNAME_DB, PASSWORD_DB);
    }

    /**
     * Запрос пользователя по email
     * @param $email
     * @return bool
     */
    protected function getUser($email)
    {
        global $pdo;
        $sql = "SELECT * FROM `users` WHERE `email` = :user_email";
        $statement = $pdo->prepare($sql);
        $statement->execute(["user_email" => $email]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Добавление нового пользователя в базу
     * @param $email
     */
    protected  function addUser($email)
    {
        global $pdo;
        $sql = "INSERT INTO `users` (`email`, `order_count`) VALUES (:user_email, 0)";
        $statement = $pdo->prepare($sql);
        $statement->execute(["user_email" => $email]);
    }

    /**
     * Добавление новго заказа в базу
     * @param $userId
     */
    protected function addOrder($userId)
    {
        global $pdo;
        $sql = "UPDATE `users` SET `order_count` = `order_count`+1 WHERE `id`=:user_id";
        $statement = $pdo->prepare($sql);
        $statement->execute(["user_id" => $userId]);
    }

}





