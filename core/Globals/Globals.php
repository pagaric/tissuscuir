<?php

namespace Core\Globals;

class Globals
{
    /**
     * @var array
     */
    private $post;

    /**
     * @var array
     */
    private $get;

    /**
     * @var array
     */
    private $files;

    /**
     * @var array
     */
    private $request;

    /**
     * @var array
     */
    private $server;

    /**
     * Globals constructor.
     */
    public function __construct()
    {
        // TODO ajouter input_filter
        $this->post = $_POST;
        $this->get = $_GET;
        $this->files = $_FILES;
        $this->request = $_REQUEST;
        $this->server = $_SERVER;
    }

    /**
     * @return array
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @return array
     */
    public function getGet()
    {
        return $this->get;
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @return array
     */
    public function getCookie()
    {
        return $_COOKIE;
    }

    public function setCookie($key, $value, $exp)
    {
        setcookie($key, $value, $exp);
    }

    /**
     * @return array
     */
    public function getSession()
    {
        return $_SESSION;
    }

    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @return array
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return array
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * @param $key
     * @return array|false|string
     */
    public function getEnv(string $key)
    {
        return getenv($key);
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->server["REQUEST_URI"];
    }
}