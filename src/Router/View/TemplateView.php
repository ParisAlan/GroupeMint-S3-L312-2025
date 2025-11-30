<?php

namespace Framework312\Router\View;

use Framework312\Router\View\BaseView;
use Framework312\Router\Exception as RouterException;
use Framework312\Router\Request;
use Framework312\Template\Renderer;
use Symfony\Component\HttpFoundation\Response;

abstract class TemplateView extends BaseView {

    static public function use_template(): bool
    {
        return true; // Puisque c'est TemplateView, il utilise un template, donc true
    }

    public function render( Request $request): Response
    {
       // TODO
        // getMethod va chercher la méthode approprié ( get, post, delete, ... )
        // Convertit "GET", "POST", etc... en minuscules pour correspondre aux méthodes get(), post() de la méthode mère
        $method = strtolower($request->getMethod());

        // Exécute la méthode (get(), post(), etc.) et récupère les données comme pour les autres views
        $data = $this->$method($request);

        // Render->register ??

        // Renvoie une response Symfony correctement typée
        return new Response(
            $template,
            Response::HTTP_OK,
            ['Content-Type' => 'unknown']
        );
    }
}