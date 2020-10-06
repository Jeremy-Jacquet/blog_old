<?php
namespace App\library\BlogFram;

use App\library\BlogFram\Translate;

trait Route
{
    private $modulesWithAction = [POSTS, CATEGORIES, COMMENTS, AUTHORS, USERS, CONTACT];
    private $modulesWithoutAction = [HOME, ADMIN, LOGIN, LOGOUT, PROFILE, REGISTER];

    use Translate;

    public function getRouteByController($controllerName, $module, $action = null)
    {
        if($controllerName === 'backend') {
            if(is_null($action)) {
                $route = 'displayAdminModule';
            } else {
                $route = 'displayAdmin'.ucfirst($this->translate($action));
            }
        } elseif($controllerName === 'frontend') {
            $route = 'display'.ucfirst($this->translate($module));
        }
        return $route;
    }

    public function verifyRoute($access, $module, $action, $id)
    {
        $result = false;
        // Routes about admin (with action)
        if($access == ADMIN) {
            if(in_array($module, $this->modulesWithAction)) {
                if(is_null($action)) {
                    $result = true;
                }
                elseif($action == ADD){
                    $result = (is_null($id))? true : false;
                } elseif($action == (UP OR DEL)) {
                    $result = (($id !== null) AND is_numeric($id))? true : false;
                }
            } elseif($module == DASHBOARD) {
                $result = true;
            }
        }
        // Routes not about admin (without action)
        else {
            if(in_array($module, $this->modulesWithAction) OR in_array($module, $this->modulesWithoutAction)) {
                if(is_null($action)) {
                    $result = (is_numeric($id) OR is_null($id))? true : false;
                }
            }
        }
        return $result;
    }

}
