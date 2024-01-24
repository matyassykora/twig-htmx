<?php

declare(strict_types=1);

namespace Maty\TwigHtmx;

use Bramus\Router\Router;
use Maty\TwigHtmx\backend\Handlers;

require_once '../vendor/autoload.php';
require_once './backend/Router.php';
require_once './backend/Handlers.php';

$handlers = new Handlers('views/');
$router = new Router();

$router->set404($handlers->handleNotFoundGet);

$router->get('/', $handlers->handleIndexGet);

$router->get('/tabs(/\d+)?', $handlers->handleTabsGet);

$router->run();
