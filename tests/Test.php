<?php
declare(strict_types=1);
include_once __DIR__ . "/../src/pdo.php";
include_once __DIR__ . "/../src/config.php";

use PHPUnit\Framework\TestCase;

class OrderListTest extends TestCase
{

    /**
     * Константа с email для теста с заказом, оформленным с новым email
     */
    const NEW_EMAIL = "exampl2@mail.ru";

    /**
     * Валидность email
     */
    public function testInvalidEmail()
    {
        $this->assertEquals(["errors" => "Некорректный email"], main("nikovasikmail.ru"));
    }

    /**
     * Заказ, оформелнный с новым email
     */
    public function testOrderFromNewEmail()
    {
        $pdo = new PDO(DSN_DB, USERNAME_DB, PASSWORD_DB);
        $sql = "SELECT auto_increment FROM information_schema.tables WHERE table_schema = 'users_bd' AND table_name = 'users'";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $currentID = $statement->fetch();
        $this->assertEquals(["result" => ["id" => $currentID[0], "email" => self::NEW_EMAIL, "order_count" => 1]], main(self::NEW_EMAIL));
    }

    /**
     * Заказ, оформленный с уже существующим email
     */
    public function testOrderFromExistedEmail()
    {
        $pdo = new PDO(DSN_DB, USERNAME_DB, PASSWORD_DB);
        $sql = "SELECT `order_count` FROM `users` WHERE `id` = 1";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $currentNumOfOrder = $statement->fetch();
        $this->assertEquals(["result" => ["id" => 1, "email" => "hugopochta@gmail.com", "order_count" => $currentNumOfOrder[0]]], main("hugopochta@gmail.com"));
    }

    /**
     * Заказ, оформленный с уже существующим email, только в верхнем регистре
     */
    public function testOrderFromExistedEmailWithUpperCase()
    {
        $pdo = new PDO(DSN_DB, USERNAME_DB, PASSWORD_DB);
        $sql = "SELECT `order_count` FROM `users` WHERE `id` = 1";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $currentNumOfOrder = $statement->fetch();
            $this->assertEquals(["result" => ["id" => 1, "email" => "hugopochta@gmail.com", "order_count" => $currentNumOfOrder[0]]], main("HUGOPOCHTA@gmail.com"));
    }

    /**
     * Удаление элементов базы данных, созданных во время тестирования
     */
    public function __destruct()
    {
        $pdo = new PDO(DSN_DB, USERNAME_DB, PASSWORD_DB);
        $sql = "DELETE FROM `users` WHERE `email` = :user_email";
        $statement = $pdo->prepare($sql);
        $statement->execute(["user_email" => self::NEW_EMAIL]);
    }
}
