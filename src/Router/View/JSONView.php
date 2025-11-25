<?php

use Framework312\Router\View\BaseView;
use Framework312\Router\Request;
use Symfony\Component\HttpFoundation\Response;

class JSONView extends BaseView {

    static public function use_template(): bool
    {
        return false; // Puisque c'est du HTML, il n'utilise pas de template, donc false
    }

    public function render( Request $request): Response
    {
        // TODO: Implement render() method.
    }
}