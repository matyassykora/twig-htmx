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

$router->get('/tabs', $handlers->handleTabsGet);
$router->get('/tabs/(\d+)?', $handlers->handleTabGet);

$router->get('/lorem', function () {
    echo <<<EOD
            Lorem ipsum dolor sit amet, officia excepteur ex fugiat reprehenderit enim labore culpa sint ad nisi Lorem pariatur mollit ex esse exercitation amet. Nisi anim cupidatat excepteur officia. Reprehenderit nostrud nostrud ipsum Lorem est aliquip amet voluptate voluptate dolor minim nulla est proident. Nostrud officia pariatur ut officia. Sit irure elit esse ea nulla sunt ex occaecat reprehenderit commodo officia dolor Lorem duis laboris cupidatat officia voluptate. Culpa proident adipisicing id nulla nisi laboris ex in Lorem sunt duis officia eiusmod. Aliqua reprehenderit commodo ex non excepteur duis sunt velit enim. Voluptate laboris sint cupidatat ullamco ut ea consectetur et est culpa et culpa duis.
            EOD;
});

$router->run();
