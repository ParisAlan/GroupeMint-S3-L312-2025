<?php declare(strict_types=1);

namespace Framework312\Router;

// importation du router
use Framework312\Router\Exception as RouterException;
// importation renderer, utilisé seulement pour les templateviews
use Framework312\Template\Renderer;
// composants fournis par Symfony pour gérer la requête et la réponse HTTP
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Route {
    // nom complet de la classe de base que toutes les View doivent trouver
    private const VIEW_CLASS = 'Framework312\Router\View\BaseView';
    // mléthode obligatoire que chaque View doit avoir
    private const VIEW_USE_TEMPLATE_FUNC = 'use_template';
    private const VIEW_RENDER_FUNC = 'render';

    // Chaîne contenant le nom de la classe de la View associée à cette route
    private string $view;

    /**
     * le constructeur reçoit soit :
     * - un nom de classe (type string)
     * - un objet View déjà dit plus haut
     *
     * Le code vérifie si cette classe est bien une sous-classe de BaseView.
     */
    public function __construct(string|object $class_or_view) {
        // ReflectionClass permet d'inspecter la classe passée en argument
        $reflect = new \ReflectionClass($class_or_view);
        // On récupère son nom complet (namespace + nom)
        $view = $reflect->getName();
         // Vérifie que la classe étend bien BaseView
        if (!$reflect->isSubclassOf(self::VIEW_CLASS)) {
            // si c'est pas le cas : 
            throw new RouterException\InvalidViewImplementation($view);
        }
         // on stocke le nom de la classe
        $this->view = $view;
    }

     /**
     * Askip on devra ici, Appeller la View correcte pour générer une Response à partir de la Request.
     * puis on devras instancier la View, appeler ses méthodes, etc.
     */
    public function call(Request $request, ?Renderer $engine): Response {
	    // TODO
        // 1. récupère la classe de la View
        $viewClass = $this->view;

        // 2. on regarde le constructeur de la classe
        $reflect   = new \ReflectionClass($viewClass);
        $ctor      = $reflect->getConstructor();

        // 3. on instancie soit avec Renderer, soit sans
        if ($ctor !== null && $ctor->getNumberOfParameters() > 0) {
            // la view veux un argument (tempmatevoew)
            $view = new $viewClass($engine);
        } else {
            // la view prend rien en paramètre 
            $view = new $viewClass();
        }

        // 4. si elle utilise un template, on prépare le renderer
        if (method_exists($viewClass, self::VIEW_USE_TEMPLATE_FUNC)
            && $viewClass::use_template() 
            && $engine !== null) {

            // on enregistre le tag pour les templates
            $engine->register($viewClass);
        }

        // 5. on demande à la View de produire la réponse
        return $view->{self::VIEW_RENDER_FUNC}($request);
    }
}

  // Le moteur de rendu (TwigRenderer dans ce projet)
class SimpleRouter implements Router {
    private Renderer $engine;

    public function __construct(Renderer $engine) {
        $this->engine = $engine;
        // TODO
    }
//  $router = new SimpleRouter($engine);
//  $router->register('/book/world  /book/7ABd9x', 'Book');

    // associe un chemin (ex: "/book/:id") à une classe de View (ex: "Book")
    public function register(string $path, string|object $class_or_view) {
        $this->path = $path;
        $this->class_or_view = $class_or_view;
	    // TODO
    }

    public function serve(mixed ...$args): void {
	    // TODO
    }
}

?>
