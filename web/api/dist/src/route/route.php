<?
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require dirname($_SERVER['DOCUMENT_ROOT']) . '/html/src/lib/Api.php';

$api = new Api();

$app->get('/categories', function(Request $request, Response $response, $args) use($api) {
    $results = $api->getCategories();
    $results = json_encode($results, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->getBody()
            ->write($results);
    return $response;
});

$app->get('/mainevents', function(Request $request, Response $response, $args) use($api) {
    $results = $api->getAllMainEvents();
    $results = json_encode($results, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->getBody()
            ->write($results);
    return $response;
});

$app->get('/change/{eventID}[/{limit}]', function(Request $request, Response $response, $args) use($api) {
    $results = $api->getChange($args['eventID'],$args['limit']);
    $results = json_encode($results, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->getBody()
            ->write($results);
    return $response;
});

$app->get('/', function(Request $request, Response $response, $args) {
    $response->getBody()->write("Főoldal");
    return $response;
});