<?php

namespace App\Repository;

use App\Util\MySqlUtils;

//Базовая реализация стора
abstract class BaseStore implements Store
{
    //этот метод необходямо переопределить для базового функционала, так как он получает имя таблицы для запросов
    abstract function getTableName(): String;

    protected PDO $connection;

    /**
     * Repository constructor.
     */
    public function __construct()
    {
        $this->connection = MySqlUtils::getConnection();
    }

    public function delete($id)
    {
        $stmt = $this->connection->prepare('DELETE FROM $this->getTableName() WHERE id = ?');
        $stmt->execute($id);
    }

}