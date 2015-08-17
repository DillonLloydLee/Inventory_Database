<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Item.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=inventory';
        $username = 'root';
        $password = 'root';
        $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->post("/delete_items", function() use ($app) {
        Item::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    $app->post("/inventory", function () use ($app) {
        $item = new Item("id", $_POST['name']);
        $item->save();
        return $app['twig']->render("index.html.twig", array("item" =>
        Item::getAll()));
    });

    return $app;

 ?>
