<?php

use Framework312\Router\View\BaseView;
use Framework312\Router\Exception as RouterException;
use Framework312\Router\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class TemplateView extends BaseView {

    static public function use_template(): bool
    {
        return true; // Puisque c'est TemplateView, il utilise un template, donc true
    }

    public function render( Request $request): Response
    {
       // TODO
    }
}