<?
use Slim\Factory\AppFactory;

require dirname($_SERVER['DOCUMENT_ROOT']) . '/html/lib/Database.php';
require dirname($_SERVER['DOCUMENT_ROOT']) . '/html/vendor/autoload.php';

$app = AppFactory::create();

$app->addErrorMiddleware(true, false, false);

require dirname($_SERVER['DOCUMENT_ROOT']) . '/html/route/route.php';

$app->run($configuration);