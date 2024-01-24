<?php

declare(strict_types=1);

namespace Maty\TwigHtmx\backend;

use Closure;

class Handlers
{
    private $twig;

    public Closure $handleNotFoundGet;
    public Closure $handleIndexGet;
    public Closure $handleTabsGet;

    private $todos = array(
        0 => array(
            "ID" => "A",
            "Name" => "Thing"
        ),
        1 => array(
            "ID" => "B",
            "Name" => "Stuff"
        )
    );

    public function __construct(private string $dir)
    {
        $loader = new \Twig\Loader\FilesystemLoader($dir);
        $this->twig = new \Twig\Environment($loader);

        $this->handleNotFoundGet = function () {
            http_response_code(404);
            echo $this->twig->render('404.html.twig');
        };

        $this->handleIndexGet = function () {
            echo $this->twig->render('index.html.twig', array(
                "todos" => $this->todos
            ));
        };

        /*
        // a different way
        public function handleIndexGet(){
            return function(){
            ...
            };
        }
        */

        $this->handleTabsGet = function ($tab) {
            if ($tab < 1 || $tab > 3) {
                $tab = 1;
            }
            $context = array(
                'tab' => $tab
            );
            $isHTMXRequest = isset($_SERVER['HTTP_HX_REQUEST']) && $_SERVER['HTTP_HX_REQUEST'] == 'true';
            if (!$isHTMXRequest) {
                echo $this->twig->render('tabs.html.twig', $context);
                return;
            }
            echo $this->twig->render('partials/tabs/tab.html.twig', $context);
        };
    }
}
