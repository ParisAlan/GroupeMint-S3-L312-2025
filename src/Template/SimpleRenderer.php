<?php declare(strict_types=1);

use Framework312\Router\Exception as RouterException;
use Framework312\Template\Renderer;
use Symfony\Component\HttpFoundation\Request; // Rajout de Request
use Symfony\Component\HttpFoundation\Response;

class TwigRenderer implements Renderer {

    public function __construct(Renderer $engine) {

    }

    public function render(mixed $data, string $template): string
    {
        // TODO
    }

    public function register(string $tag)
    {
        // TODO
    }
}