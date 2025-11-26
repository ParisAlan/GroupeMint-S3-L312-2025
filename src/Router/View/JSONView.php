<?php

namespace Framework312\Router\View;

use Framework312\Router\View\BaseView;
use Framework312\Router\Exception as RouterException;
use Framework312\Router\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class JSONView extends BaseView {

    static public function use_template(): bool
    {
        return false; // Puisque c'est du JSON, il n'utilise pas de template, donc false
    }

    public function render( Request $request): Response
    {
        // getMethod va chercher la méthode approprié ( get, post, delete, ... )
        // Convertit "GET", "POST", etc... en minuscules pour correspondre aux méthodes get(), post() de la méthode mère
        $method = strtolower($request->getMethod());

        // Exécute la méthode (get(), post(), etc.) et récupère les données
        $data = $this->$method($request);

        // On va transformer les données en JSON.
        $json = json_encode($data, JSON_PRETTY_PRINT); // https://www.php.net/manual/en/function.json-encode.php
        // le flag est optionnel mais on a quand même décidé de mettre celui qui rend le JSON plus lisible
        // https://www.php.net/manual/en/json.constants.php#constant.json-pretty-print

        // Renvoie une response Symfony correctement typée
        return new Response(
            $json,
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}