<?php
namespace App\library\BlogFram;

use App\library\Entity\User;

trait Security
{
    public static function secure($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function secureArray(array $array = [])
    {
        if(!empty($array)) {
            foreach ($array as $key => $value) {
                $secureArray [$key] = self::secure($value);
            }
            return $secureArray;

        }
    }

    public function isFormValid($module, $action = null)
    {
        if(is_null($action)) {
            if($module === LOGIN) {
                return $this->isPOST(['pseudo', 'pass']) ? true : false;
            } elseif($module === REGISTER) {
                return $this->isPOST(['pseudo', 'pass', 'pass2', 'email']) ? true : false;
            }
        } else { 
            if($action === UP OR DEL) {
                return $this->isPOST(['id']) ? true : false;
            } else if($module === ADD) {
                if($module === POSTS) {
                    return $this->isPOST(['title', 'sentence', 'content', 'idCategory', 'idAuthor']) ? true : false;
                } elseif($module === COMMENTS) {
                    return $this->isPOST(['content', 'idUser', 'idArticle', 'validate']) ? true : false;
                } elseif($module === CATEGORIES) {
                    return $this->isPOST(['title', 'validate']) ? true : false;
                } elseif($module === AUTHORS) {
                    return $this->isPOST(['firstname', 'lastname', 'validate']) ? true : false;
                } elseif($module === USERS) {
                    return $this->isPOST(['pseudo', 'pass', 'email']) ? true : false;
                }
            }
        }
    }

    public function isPOST(array $array = [])
    {
        $result = 0;
        foreach($array as $key) {
            if(!isset($_POST[$key]) OR empty($_POST[$key])) {
                $result ++;
            }
        }
        return ($result === 0) ? true : false;
    }

    public function isSESSION(array $array = [])
    {
        $result = 0;
        foreach($array as $key) {
            if(!isset($_SESSION[$key]) OR empty($_SESSION[$key])) {
                $result ++;
            }
        }
        return ($result === 0) ? true : false;
    }

    public function isConnected()
    {
        if($this->isCookieProtect()) {
            return $this->isSESSION(['access']) ? true : false;
        }
    }

    public function isAdmin()
    {
        if($this->isCookieProtect()) {
            return ($_SESSION['access'] === ADMIN) ? true : false;
        }
    }

    public function isCookieProtect()
    {
        if(isset($_SESSION[COOKIE_PROTECT]) AND isset($_COOKIE[COOKIE_PROTECT])) {
            return $_SESSION[COOKIE_PROTECT] == $_COOKIE[COOKIE_PROTECT] ? true : false;
        }
    }

    public function generateCookie()
    {
        $ticket = session_id().microtime().rand(0,9999999);
        $ticket = hash("sha512", $ticket);
        $_SESSION[COOKIE_PROTECT] = $ticket;
        setcookie(COOKIE_PROTECT, $ticket, time() + (60*60));
    } 

    public function setSessionAccess(User $user)
    {
        $_SESSION['access'] = $user->getAccess();
        $_SESSION['id'] = $user->getId();
    }

    



}
