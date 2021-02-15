<?php


class MySqlUtils {

    public static function getConnection(): PDO
    {
        $dsn = "mysql:host=" . getenv("bd.host") . ";dbname=". getenv("bd.name") . ";charset=" . getenv("bd.charset");
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $dbh = new PDO($dsn, getenv("bd.user"), getenv("bd.password"), $opt);
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }

        return $dbh;
    }
}