<?php declare(strict_types=1);

namespace Framework312\Router;

use Framework312\Router\Exception as RouterException;
use Framework312\Template\Renderer;
use Symfony\Component\HttpFoundation\Request; // Rajout de Request
use Symfony\Component\HttpFoundation\Response;

class Route {
    private const VIEW_CLASS = 'Framework312\Router\View\BaseView';
    private const VIEW_USE_TEMPLATE_FUNC = 'use_template';
    private const VIEW_RENDER_FUNC = 'render';

    private string $view;

    public function __construct(string|object $class_or_view) {
        $reflect = new \ReflectionClass($class_or_view);
        $view = $reflect->getName();
        if (!$reflect->isSubclassOf(self::VIEW_CLASS)) {
            throw new RouterException\InvalidViewImplementation($view);
        }
        $this->view = $view;
    }

    public function call(Request $request, ?Renderer $engine): Response {
	    // TODO
    }
}

class SimpleRouter implements Router {
    private Renderer $engine;

    private array $routes; // On crée le tableau qui nous servira par là suite à stocker les routes

    public function __construct(Renderer $engine) {
        $this->engine = $engine;
        $this->routes = []; // On dit que c'est un tableau vide
        // TODO
    }
//  $router = new SimpleRouter($engine);
//  $router->register('/book/world', 'Book');

    public function register(string $path, string|object $class_or_view) {

        $this->routes[$path] = $class_or_view;
        // Catch-All ?
	    // TODO
    }

    public function serve(mixed ...$args): void {
	    // TODO
        $request = Request::createFromGlobals(); // Il semblerait que c'est la façon la plus commune de commencer une requete
        $request->getPathInfo();

        // https://symfony.com/doc/current/components/http_foundation.html

        $viewClass = $this->routes[$path]; // "Book" ici par exemple.
        $route = new Route($viewClass); // On crée une nouvelle route

        $response = $route->call($request, $this->engine); // Appelle la méthode Route::call

        // Préparer la réponse
        $response->prepare($request);

        // Puis envoyer
        $response->send();

        // https://symfony.com/doc/current/components/http_foundation.html dans Responses
    }
}

?>
