<?php

namespace App\library\BlogFram;

use App\library\BlogFram\Translate;

class Router
{
    use Translate;

    private $controller;
    private $route      = null;
    private $action     = null;
    private $id         = null;
    private $access     = null;
    private $actions    =   [
                                ADD,
                                UP,
                                DEL
                            ];
    private $routes     =   [
                                HOME,
                                POSTS,
                                CATEGORIES,
                                COMMENTS,
                                AUTHORS,
                                PROFILE,
                                LOGIN,
                                LOGOUT,
                                REGISTER,
                                ADMIN
                            ];

    public function __construct()
    {
        $this->setRoute();
        $this->setController();
    }

    public function getRoute()
    {
        if($this->access === ADMIN) {
            $route = 'displayAdmin'.ucfirst($this->translate($this->route));
        } elseif($this->access === null) {
            $route = 'display'.ucfirst($this->translate($this->route));
        } else {
            throw new \Exception ("La page que vous recherchez n'existe pas. (getRoute)");
        }
        return $route;
    }

    public function getController()
    {
        $controller = $this->controller;
        return $controller;
    }

    public function setRoute()
    {
        if(empty($_GET['page'])) {
            $this->route = HOME;

        } else {
            $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));

            if(empty($url[1])) {
                $this->route = $url[0];

            } elseif(empty($url[2])) {
                if($url[0] === ADMIN) {
                    $this->access = ADMIN;
                    $this->route = $url[1];              
                } else {
                    $this->route = $url[0];
                    $this->id = $url[1];
                }
                
            } elseif(empty($url[3])) {
                if($url[0] === ADMIN) {
                    $this->access = ADMIN;
                    $this->route = $url[1];
                    $this->action = $url[2];  
                } else {
                    throw new \Exception ("La page que vous recherchez n'existe pas. (getRoute n°1)");
                }

            } elseif(empty($url[4])) {
                if($url[0] === ADMIN) {
                    $this->access = ADMIN;
                    $this->route = $url[1];
                    $this->action = $url[2];
                    $this->id = $url[3]; 
                } else {
                    throw new \Exception ("La page que vous recherchez n'existe pas. (getRoute n°2)");
                }
            }
        }
        
    }

    public function setController()
    {
        if($this->access === ADMIN) {
            $this->controller = 'backend';
        } elseif ($this->route === (LOGIN OR LOGOUT OR REGISTER)) {
            $this->controller = 'backend';
        } else {
            $this->controller = 'frontend'; 
        }
    }

    public function verifyRoute($route)
    {
        if($this->route !== null) {
            if(in_array($route, $this->routes)) {
                return true;
            } else {
                throw new \Exception ("La page que vous recherchez n'existe pas. (verifyRoute)");
            }
        }
    }

    public function verifyAction($action)
    {
        if($this->action !== null) {
            if(in_array($action, $this->actions)) {
                return true;
            } else {
                throw new \Exception ("La page que vous recherchez n'existe pas. (verifyAction)");
            }
        }   
    }

    public function run()
    {
        $this->verifyRoute($this->route);
        $this->verifyAction($this->action);
        $route = $this->getRoute();
        return $route;
    }
}
