<?php

namespace App\library\BlogFram;

trait Translate
{
    private $words =    [
                        HOME => 'home',
                        POSTS => 'articles',
                        CATEGORIES => 'categories',
                        COMMENTS => 'comments',
                        AUTHORS => 'authors',
                        PROFILE => 'profile',
                        LOGIN => 'login',
                        LOGOUT => 'logout',
                        REGISTER => 'register',
                        ADMIN => 'admin'
                        ];

    public function translate($data)
    {
        foreach($this->words as $word => $newWord) {
            if($data === $word) {
                $result = $newWord;
            }
        }
        return $result;
    }


}
