<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use DI\Container;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container();

$container->set('templating', function(){
    return new Mustache_Engine([
        'loader' => new 
            Mustache_Loader_FilesystemLoader(__DIR__ . '/../templates',
                ['extension' => '']
        )
    ]);
});


AppFactory::setContainer($container);

$app = AppFactory::create();

// $app->get('/hello/{name}', function(Request $request, Response $response, array $args =[]){
//         $html = $this->get('templating')->render('hello.html', [
//             'name' => $args['name']
//         ]);
//         $response->getBody()->write($html);
//         return $response;
// });

$app->get('/', 'App\Controller\AlbumsController:default');
$app->get('/details/{id:[0-9]+}', 'App\Controller\AlbumsController:details');


$app->get('/search', 'App\Controller\AlbumsController:search');
$app->any('/form', 'App\Controller\AlbumsController:form');
$app->get('/api', 'App\Controller\ApiController:search');

// during developement, keep first paramter true, instead of false
//                      addErrorMiddleWare( >>>false<<< , true, true);
// $errorMiddleware = $app->addErrorMiddleWare(false, true, true);

// $errorMiddleware->setErrorHandler(
//     Slim\Exception\HttpNotFoundException::class,
//     function(Psr\Http\Message\ServerRequestInterface $request) use ($container){
//         $controller = new App\Controller\ExceptionController($container);
//         return $controller->notFound($request);
//     }
// );


$app->run();

// Varasemalt testitud route
//
// $app->get('/', function (Request $request, Response $response) {
//     $response->getBody()->write("Hello Slim!");
//     return $response;
// });

// $app->get('/hello/pepe', function (Request $request, Response $response) {
//     $response->getBody()->write("Hello Pepe the frog!");
//     return $response;
// });

// $app->get('/hello/{name}', function (Request $request, Response $response, array $args){
//     $name = ucfirst($args['name']);
//     $response->getBody()->write(sprintf("Hello, %s!", $name) );
//     return $response;
// });

// cd public
// php -S localhost:8000