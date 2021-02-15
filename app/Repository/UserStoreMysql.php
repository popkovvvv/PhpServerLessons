<?php

namespace App\Repository;

use App\Model\Entity;
use App\Model\User;

/**
 * Экземпляр класса для работы с бд users??
 */
class UserStoreMysql extends BaseStore implements UserStore
{
    /** @var string */
    private string $tableName = "users";

    /**
     * @param string $id
     * @return Model
     */
    public function get(string $id): Model
    {
        $stmt = $this->connection->prepare("SELECT * FROM $this->getTableName() WHERE id = ?");
        $stmt->execute($id);
        $data = $stmt->fetch();
        return new User($data->name, $data->email);
    }

    /**
     * @param Model $instance
     * @return void
     */
    public function update(Model $instance): void
    {
        $allowed = array("name", "email");
        $values = array($instance->getName(),$instance->getEmail());
        $sql = "UPDATE $this->tableName SET ".pdoSet($allowed,$values)." WHERE id = :id";
        $stm = $this->connection->prepare($sql);
        $values["id"] = $instance->getId();
        $stm->execute($values);
    }

    /**
     * @param Model $instance
     * @return void
     */
    public function put(Model $instance): void
    {
        $allowed = array("name","email");
        $values = array($instance->getName(),$instance->getEmail());
        $sql = "INSERT INTO $this->tableName SET ".pdoSet($allowed,$values);
        $stm = $this->connection->prepare($sql);
        $stm->execute($values);
    }

    /**
     * @return string
     */
    function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * @param string $name
     * @return null|User
     */
    public function getUserByName(string $name): ?User
    {
        try {
            $stm  = $this->connection->prepare("SELECT * FROM $this->tableName WHERE name = ?");
            $stm->execute($name);
            $data = $stm->fetch();
            return new User($data->name, $data->email);
        } catch (PDOException $e) {
            print($e->getMessage());
        }
        return null;
    }
}
