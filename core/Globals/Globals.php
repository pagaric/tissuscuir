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
     * @var [type]
     */
    private $cookie;

    /**
     * Globals constructor.
     */
    public function __construct()
    {
        $this->post = filter_input_array(INPUT_POST);
        $this->get = filter_input_array(INPUT_GET);
        $this->server = filter_input_array(INPUT_SERVER);
        $this->cookie = filter_input_array(INPUT_COOKIE);
        $this->files = $_FILES;
        $this->request = $_REQUEST;
    }

    /**
     * @return array|string
     */
    public function getPost(string $i)
    {
        if($i) {
            return $this->post[$i];
        }
        return $this->post;
    }

    /**
     * @return array|string
     */
    public function getGet(string $i = null)
    {
        if($i) {
            return $this->get[$i];
        }
        return $this->get;
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        if($this->files) {
            return $this->files;
        }
    }

    /**
     * @return array|string
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return array|string
     */
    public function getServer(string $i = null)
    {
        if($i) {
            return $this->server[$i];
        }
        return $this->server;
    }

    public function getCookie()
    {
        return $this->cookie;
    }

    /**
     * @param $key
     * @return array|false|string
     */
    public function getEnv(string $key)
    {
        return getenv($key);
    }

}