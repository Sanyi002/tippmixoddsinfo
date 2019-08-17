<?
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require dirname($_SERVER['DOCUMENT_ROOT']) . '/html/lib/Api.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json;charset=utf-8');

$api = new Api();

$app->get('/categories', function(Request $request, Response $response, $args) use($api) {
    $results = $api->getCategories();
    $results = json_encode($results, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    $response->withStatus(200)
            ->getBody()
            ->write($results);
    return $response;
});

$app->get('/countries[/{sportID}]', function(Request $request, Response $response, $args) use($api) {
    $results = $api->getCountries($args['sportID']);
    $results = json_encode($results, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    $response->withStatus(200)
            ->getBody()
            ->write($results);
    return $response;
});

$app->get('/mainevents', function(Request $request, Response $response, $args) use($api) {
    $results = $api->getAllMainEvents();
    $results = json_encode($results, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    $response->withStatus(200)
            ->getBody()
            ->write($results);
    return $response;
});

$app->get('/dates', function(Request $request, Response $response, $args) use($api) {
    $results = $api->getDates();
    $results = json_encode($results, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    $response->withStatus(200)
            ->getBody()
            ->write($results);
    return $response;
});

$app->get('/change/{eventID}[/{limit}]', function(Request $request, Response $response, $args) use($api) {
    $results = $api->getChange($args['eventID'],$args['limit']);
    $results = json_encode($results, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    $response->withStatus(200)
            ->getBody()
            ->write($results);
    return $response;
});

$app->get('/leagues[/{sportID}[/{countryName}]]', function(Request $request, Response $response, $args) use($api) {
    $results = $api->getLeagues($args['sportID'],$args['countryName']);
    $results = json_encode($results, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    $response->withStatus(200)
            ->getBody()
            ->write($results);
    return $response;
});

$app->get('/events/date/{date}', function(Request $request, Response $response, $args) use($api) {
    $results = $api->getEventsByDate($args['date']);
    $results = json_encode($results, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    $response->withStatus(200)
            ->getBody()
            ->write($results);
    return $response;
});

$app->get('/events[/{sportID}[/{countryName}[/{leagueName}[/{date}]]]]', function(Request $request, Response $response, $args) use($api) {
    $args['sportID'] = $args['sportID'] == 'null' ? null : $args['sportID'];
    $args['countryName'] = $args['countryName'] == 'null' ? null : $args['countryName'];
    $args['leagueName'] = $args['leagueName'] == 'null' ? null : $args['leagueName'];
    $args['date'] = $args['date'] == 'null' ? null : $args['date'];
    $results = $api->getEvents($args['sportID'], $args['countryName'], $args['leagueName'], $args['date']);
    $results = json_encode($results, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    $response->withStatus(200)
            ->getBody()
            ->write($results);
    return $response;
});

$app->get('/', function(Request $request, Response $response, $args) {
    $response->getBody()->write("Főoldal");
    return $response;
});