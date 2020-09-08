<?php
namespace App\library\BlogFram;

trait Route
{
    private $modules =   [
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

    private $actions =  [
                        ADD,
                        UP,
                        DEL,
                        null
                        ];

    public function existsModule($module)
    {
        return in_array($module, $this->modules)? true : false;
    }

    public function existsAction($action)
    {
        return in_array($action, $this->actions)? true : false;
    }


}
