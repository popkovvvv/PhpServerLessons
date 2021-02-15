<?php

namespace App\Repository;

use App\Model\Entity;

/**
 * базовый стор, где описаны общие методы для любой сущности
 */
interface Store
{
    /**
     * @param string $id 
     * @return Entity
     */
    public function get(string $id): Entity;

    /**
     * @param Entity $instance
     * @return void
     */
    public function update(Entity $instance): void;

    /**
     * @param
     */
    public function put(Entity $instance): void;

    /**
     * @param string $id
     * @return void
     */
    public function delete(string $id): void;
}