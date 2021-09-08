<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use DI\Container;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container();

AppFactory::setContainer($container);

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write("Hello Slim!");
    return $response;
});

$app->get('/hello/pepe', function (Request $request, Response $response) {
    $response->getBody()->write("Hello Pepe the frog!");
    return $response;
});

$app->get('/hello/{name}', function (Request $request, Response $response, array $args){
    $name = ucfirst($args['name']);
    $response->getBody()->write(sprintf("Hello, %s!", $name) );
    return $response;
});

$app->run();