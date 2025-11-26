<?php

use Framework312\Router\View\BaseView;
use Framework312\Router\Exception as RouterException;
use Framework312\Router\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class HTMLView extends BaseView {

    static public function use_template(): bool
    {
        return false; // Puisque c'est du HTML, il n'utilise pas de template, donc false
    }

    public function render(Request $request): Response
    {
        // getMethod va chercher la méthode approprié ( get, post, delete, ... )
        // Convertit "GET", "POST", etc... en minuscules pour correspondre aux méthodes get(), post() de la méthode mère
        $method = strtolower($request->getMethod());

//        if (!method_exists($this, $method)) {
//            throw new RouterException("Méthode HTTP non supportée : $method");
//        }

        // Exécute la méthode (get(), post(), etc.) et récupère les données
        $html = $this->$method($request);

        // Renvoie une response Symfony correctement typée
        return new Response(
            $html,
            Response::HTTP_OK,
            ['Content-Type' => 'text/html']
        );
    }
}