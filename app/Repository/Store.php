<?php

namespace App\Repository;

//базовый стор, где описаны общие методы для любой сущности
interface Store
{
    public function get(string $id);
    public function update($instance);
    public function delete(string $id);
    public function put($instance);
}