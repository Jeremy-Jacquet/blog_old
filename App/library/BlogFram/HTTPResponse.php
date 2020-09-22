<?php
namespace App\library\BlogFram;

class HTTPResponse
{
    private $access;
    private $module;
    private $action;
    private $id;
    private $post = [];
    private $controllerName;

    public function __construct($url, $post)
    {
        $this->setAttributesByRoute($url);
        $this->setPost($post);
        $this->setController();
    }
    
    public function setAttributesByRoute($url)
    {
        if(empty($url)) {
            $this->setModule(HOME);
        } else {
            if(empty($url[1])) {
                if($url[0] === ADMIN) {
                    $this->setAttributes(ADMIN_ACCESS, DASHBOARD, null, null);
                } else {
                    $this->setAttributes(USER_ACCESS, $url[0], null, null);
                }
            } elseif(empty($url[2])) {
                if($url[0] === ADMIN) {
                    $this->setAttributes(ADMIN_ACCESS, $url[1], null, null);
                } else {
                    $this->setAttributes(USER_ACCESS, $url[0], null, $url[1]);
                }       
            } elseif(empty($url[3])) {
                if($url[0] === ADMIN) {
                    $this->setAttributes(ADMIN_ACCESS, $url[1], $url[2], null);
                }
            } elseif(empty($url[4])) {
                if($url[0] === ADMIN) {
                    $this->setAttributes(ADMIN_ACCESS, $url[1], $url[2], $url[3]);
                }
            }
        }
    }

    public function setAttributes($access, $module, $action = null, $id = null) {
        $this->setAccess($access);
        $this->setModule($module);
        $this->setAction($action);
        $this->setId($id); 
    }

    // GETTERS

    public function getAccess()
    {
        return $this->access;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }

    //SETTERS

    public function setAccess($access)
    {
        $this->access = $access;
    }

    public function setModule($module)
    {
        $this->module = $module;
    }

    public function setAction($action)
    {
        $this->action = $action;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setPost($post)
    {
        $this->post = $post;
    }

    public function setController()
    {
        if($this->getAccess() === ADMIN) {
            $this->controllerName = 'backend';
        }elseif($this->getModule() === (LOGIN OR LOGOUT OR REGISTER)) {
            $this->controllerName = 'backend';
        } else {
            $this->controllerName = 'frontend';
        }
    }

}