<?php

namespace App\Repository;

//Стор для конкретной сущности нужен что бы выделить методы которые подходят только для этого типа сущности
interface UserStore extends Store
{
    /**
     * @param string $name
     * @return null|User
     */
    public function getUserByName(string $name): ?User;
}