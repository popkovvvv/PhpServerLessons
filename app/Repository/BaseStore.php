<?php

namespace App\Repository;

use App\Util\MySqlUtils;

/**
 * Базовая реализация стора
 */
abstract class BaseStore implements Store
{
    /**
     * этот метод необходямо переопределить для базового функционала, так как он получает имя таблицы для запросов
     * @return string
     */
    abstract function getTableName(): string;

    /** @var PDO */
    protected PDO $connection;

    /**
     * Repository constructor.
     */
    public function __construct()
    {
        $this->connection = MySqlUtils::getConnection();
    }

    /**
     * @param strind $id
     * @return void
     */
    public function delete(string $id): void
    {
        $stmt = $this->connection->prepare('DELETE FROM $this->getTableName() WHERE id = ?');
        $stmt->execute($id);
    }

}