<?php

use Framework312\Router\View\BaseView;
use Framework312\Router\Exception as RouterException;
use Framework312\Router\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class HTMLView extends BaseView {

    static public function use_template(): bool
    {
        return false; // Puisque c'est du HTML, il est censé renvoyer uniquement du HTML et rien d'autres ?
        // donc pas de template donc false ?
    }

    public function render(Request $request): Response
    {
        // TODO: Implement render() method.
    }
}