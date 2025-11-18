<?php declare(strict_types=1);

namespace Framework312\Router;

use Framework312\Router\Exception as RouterException;
use Framework312\Template\Renderer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Route {
    //constante qui definit la classe parente obligatoire pour toutes les Views
    private const VIEW_CLASS = 'Framework312\Router\View\BaseView';
    // propriété qui stocke le nom complet de la classe View quest associee a cette route : (ex: 'App\Views\Book') comme dans l'énoncé
    private const VIEW_USE_TEMPLATE_FUNC = 'use_template'; //jsp si c utile du coup ?
    private const VIEW_RENDER_FUNC = 'render'; //jsp si c utile du coup ?

    // propriété qui va stocker le nom complet de la classe View associée à cette route (ex: 'App\Views\Book').
    private string $view;


    public function __construct(string|object $class_or_view) {
        // La ReflectionClass elle permet de voir la classe (méthodes, héritage, nom......) à l'exécution
        $reflect = new \ReflectionClass($class_or_view);
        // Récupère le nom complet de la classe (avec le namespace) du coup
        $view = $reflect->getName();
        //verif que la classe implémente bien la BaseView


        // on verif que la classe choisie descend bien de BaseView
        // et ca force l'utilisateur à respecter le squelette du framework avec le : && self::VIEW_CLASS !== $view)
        if (!$reflect->isSubclassOf(self::VIEW_CLASS)&& self::VIEW_CLASS !== $view) {

            throw new RouterException\InvalidViewImplementation($view);
            //rajouter la possibilité d'un non respect de l'architecture du framework
        }
        // Stocke le nom de la classe si la vérification réussit.
        $this->view = $view;
    }


    public function call(Request $request, ?Renderer $engine): Response {
        // instanciation de la View donc on utilise $this->view pour que le nom de la classe soit stocké
        $viewInstance = new $this->view($engine);
    }
}

class SimpleRouter implements Router {
    private Renderer $engine;
    // c obligé pour stocker les associations chemin -> View.
    private array $routes = [];

    public function __construct(Renderer $engine) {
        $this->engine = $engine;
        // TODO
    }

    public function register(string $path, string|object $class_or_view) {
        // TODO
        // 1 = instancie la classe Route pour valider la View (qui est baseView a la BAAASE)
        $route = new Route($class_or_view);

        // 2 = ca stock l'objet Route dans le tableau de routes et ca utilise le chemin comme clé
        $this->routes[$path] = $route;
    }

    public function serve(mixed ...$args): void {
        // TODO
        // 1 = Créer la Request à partir des variables globales de Symfony HttpFoundation je supose ?
        $request = Request::createFromGlobals();
        $path = $request->getPathInfo(); // Récupère le chemin d'URL (ex: /book/123)
        $matchedRoute = null;

    }
}

?>