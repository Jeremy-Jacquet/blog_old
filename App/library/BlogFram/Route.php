<?php
namespace App\library\BlogFram;

use App\library\BlogFram\Translate;

trait Route
{
    private $modulesWithAction = [POSTS, CATEGORIES, COMMENTS, AUTHORS, USERS];
    private $modulesWithoutAction = [HOME, ADMIN, LOGIN, LOGOUT, PROFILE, REGISTER];

    use Translate;

    public function getRouteByController($controllerName, $module)
    {
        if($controllerName === 'backend') {
            $route = 'displayAdmin'.ucfirst($this->translate($module));
        } elseif($controllerName === 'frontend') {
            $route = 'display'.ucfirst($this->translate($module));
        }
        return $route;
    }

    public function verifyRoute($access, $module, $action, $id)
    {
        if($access === ADMIN) {
            if(in_array($module, $this->modulesWithAction)) {
                if($action === null) {
                    return true;
                }
                elseif($action === (ADD)){
                    if($id === null){
                        return true;
                    }
                } elseif($action === (UP OR DEL)) {
                    if(($id !== null) AND is_numeric($id)) {
                        return true;
                    }
                }
            }
        } else {
            if(in_array($module, $this->modulesWithAction) OR in_array($module, $this->modulesWithoutAction)) {
                if($action === null) {
                    if((($id !== null) AND is_numeric($id)) OR ($id === null)) {
                        return true;
                    }
                }
            }
        }

    }

}
