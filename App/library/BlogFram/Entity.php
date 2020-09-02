<?php
namespace App\library\BlogFram;

abstract class Entity
{
    public function __construct(array $array)
    {
        if(!empty($array)) {
            $this->hydrate($array);
        }   
    }

    public function hydrate(array $array)
    {
        foreach ($array as $key => $value) {
            $method = 'set'.ucfirst($key);

            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }
}
