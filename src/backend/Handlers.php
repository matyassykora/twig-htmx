<?php

declare(strict_types=1);

namespace Maty\TwigHtmx\backend;

use Closure;

class Handlers
{
    public Closure $handleNotFoundGet;
    public Closure $handleIndexGet;
    public Closure $handleTabsGet;
    public Closure $handleTabGet;

    private $todos = array(
        0 => array(
            "ID" => "A",
            "Name" => "PEPA Z DEPA"
        ),
        1 => array(
            "ID" => "B",
            "Name" => "TONDA Z BRNA"
        )
    );

    private $twig;

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

        $this->handleTabsGet = function ($tab = -1) {
            $context = array(
                'tab' => $tab
            );
            echo $this->twig->render('tabs.html.twig', $context);
        };

        $this->handleTabGet = function ($tab) {
            if ($tab <-1 || $tab > 3) {
                $tab = 1;
            }
            $isHTMXRequest = isset($_SERVER['HTTP_HX_REQUEST']) && $_SERVER['HTTP_HX_REQUEST'] == 'true';
            if (!$isHTMXRequest) {
                call_user_func($this->handleTabsGet, $tab);
                return;
            }
            $context = array(
                'tab' => $tab
            );
            echo $this->twig->render('partials/tabs/tab.html.twig', $context);
        };
    }
}
