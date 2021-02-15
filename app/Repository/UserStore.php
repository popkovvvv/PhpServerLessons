<?php

namespace App\Repository;

//Стор для конкретной сущности нужен что бы выделить методы которые подходят только для этого типа сущности
interface UserStore extends Store
{
    function getUserByName(string $name): ?User;
}