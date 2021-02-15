<?php

require __DIR__ . '/vendor/autoload.php';

\App\Util\Router::route('/', function(){
    $userRepository = new UserStoreMysql();
    $user = $userRepository->get("342434");
    print_r($user->getEmail());
    $saveUser = new User("Dima", "lox@mail.ru");
    $userRepository->put($saveUser);

    print 'Домашняя станица';
});

Router::route('blog/(\w+)/(\d+)', function($category, $id){
    print $category . ':' . $id;
});


// запускаем маршрутизатор, передавая ему запрошенный адрес
Router::execuute($_SERVER['REQUEST_URI']);


//Дима что бы запустить свой сервер необходимо в консоль написать php -S localhost:8000 Index.php
// Тебе не нужен будет openserver если использовать эту консольную команду, но база у тебя должна работать


//ДЛЯ ПОДКЛЮЧЕНИЯ К БД В .ENV заполни свои данные

/**
 * Твое дз:
 * Все запустить, проверить все запросы которые есть, разобраться как это работает, исправить баги если будут, написать свою модель
 * как User и написать к нему кастомный стор, вообщем все как у меня
 */