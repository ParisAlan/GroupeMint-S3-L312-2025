<?php declare(strict_types=1);

namespace Framework312\Template;

use Framework312\Router\Exception as RouterException;
use Framework312\Template\Renderer;
use Twig\Environment; // On rajoute ce qu'il faut pour le bon fonctionnement de Twig
use Twig\Loader\FilesystemLoader; // On rajoute ce qu'il faut pour le bon fonctionnement de Twig

class TwigRenderer implements Renderer {

    private string $templateDir;
    private FilesystemLoader $loader; // On met en place le systemLoader comme $engine a été mis en place dans SimpleRouter
    private Environment $twig; // On met en place l'environnement Twig

    public function __construct(string $templateDir) { // dans l'exemple, il reçoit /templates/

        $this->templateDir = $templateDir;
        // Partie Basics de la documentation : https://twig.symfony.com/doc/3.x/api.html
        $this->loader = new FilesystemLoader($templateDir);
        $this->twig = new Environment($this->loader);
    }

    public function render(mixed $data, string $template): string
    {
        return $this->twig->render($template, $data); // https://twig.symfony.com/doc/3.x/api.html
        // On n'utilise pas twig->load() car render() fait la même chose mais en prenant en compte les données.
        // render() accepte deux paramètres ($template et $data) alors que load() ne charge que le template.
    }

    public function register(string $tag): void {

        $lastChar = substr($this->templateDir, -1); // On utilise substr pour aller chercher le dernier caractère

        // Pour éviter des bugs ou des doubles slash dans le chemin,
        // si le dernier caractère n'est pas un "/", on lui rajoute
        if ( $lastChar !== '/') {
            $this->templateDir .= '/';
        }

        $path = $this->templateDir . $tag;
        // Concatène le dossier de base avec le nom du tag pour créer le chemin complet
        $this->loader->addPath($path, $tag); // On spécifique que le "namespace" sera @"$tag" de notre choix
    }
}