<?php

namespace App\Routes;

class Route
{
    private $path;
    private $action;
    private $matches = [];

    /**
     * Undocumented function
     *
     * @param string $path
     * @param array|string $action
     */
    public function __construct(string $path, $action)
    {
        $this->path = trim($path, '/');
        $this->action = $action;
    }

    public function matches(string $url): bool
    {
        // On remplace tout ce qui commence par ':' suivi alphaNum plusieurs fois
        // par n'importe quoi qui ne soit pas un '/'
        $path = preg_Replace('#:([\w]+)#', '([^/]+)', $this->path);

        $pathToMatch = "#^$path$#";

        if(preg_match($pathToMatch, $url, $matches)) {
            $this->matches = $matches;
            return true;
        } else {
            return false;
        }
    }

    public function execute()
    {
        if(is_array($this->action)) {
            $controller = new $this->action[0]();
            $method = $this->action[1];
        } else {
            $params = explode('@', $this->action);
            $controller = new $params[0]();
            $method = $params[1];
        }

        // si matches contient un id, on appelle la méthode avec cet id
        return isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method();
    }

}