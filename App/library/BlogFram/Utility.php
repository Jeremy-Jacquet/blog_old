<?php
namespace App\library\BlogFram;

use App\library\BlogFram\Security;

trait Utility
{
    use Security;
    
    public function getPostToArray()
    {
        foreach ($_POST as $key => $value) {
            $key = $this->secure($key);
            $value = $this->secure($value);
            $array [$key] = $value;
        }
        return $array;
    }

    public function getPostToAttribute()
    {
        foreach($_POST as $key => $value) {
            $attribute = $key;
        }
        return $attribute;
    }

    public function getPostToValue()
    {
        foreach($_POST as $key => $value) {
            $value = $value;
        }
        return $value;
    }


}
