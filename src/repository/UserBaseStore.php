<?php


class UserStoreMysql extends BaseStore implements UserStore
{

    private String $tableName = "users";

    public function update($instance)
    {
        if ($instance instanceof User) {
            $allowed = array("name","email");
            $values = array($instance->getName(),$instance->getEmail());
            $sql = "UPDATE $this->tableName SET ".pdoSet($allowed,$values)." WHERE id = :id";
            $stm = $this->connection->prepare($sql);
            $values["id"] = $instance->getId();
            $stm->execute($values);
        }
    }

    public function put($instance)
    {
        if ($instance instanceof User) {
            $allowed = array("name","email");
            $values = array($instance->getName(),$instance->getEmail());
            $sql = "INSERT INTO $this->tableName SET ".pdoSet($allowed,$values);
            $stm = $this->connection->prepare($sql);
            $stm->execute($values);
        }
    }

    function getTableName(): string
    {
        return $this->tableName;
    }

    function getUserByName(string $name): ?User
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

    public function get($id): User
    {
        $stmt = $this->connection->prepare('SELECT * FROM $this->getTableName() WHERE id = ?');
        $stmt->execute($id);
        $data = $stmt->fetch();
        return new User($data->name, $data->email);
    }
}