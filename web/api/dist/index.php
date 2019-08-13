<?
use Slim\Factory\AppFactory;

require dirname($_SERVER['DOCUMENT_ROOT']) . '/html/src/lib/Database.php';
require dirname($_SERVER['DOCUMENT_ROOT']) . '/html/src/vendor/autoload.php';
#require dirname($_SERVER['DOCUMENT_ROOT']) . '/html/src/lib/Api.php';

$app = AppFactory::create();

$app->addErrorMiddleware(true, false, false);

require dirname($_SERVER['DOCUMENT_ROOT']) . '/html/src/route/route.php';

$app->run($configuration);