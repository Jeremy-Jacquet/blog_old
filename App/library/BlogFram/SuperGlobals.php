<?php
namespace App\library\BlogFram;

class SuperGlobals
{
    private $_SERVER;
    private $_POST;
    private $_GET;
    private $_SESSION;

    public function __construct()
    {
        $this->defineSuperglobals();
    }
    /**
     * Returns a key from the superglobal,
     * as it was at the time of instantiation.
     * FR:
     * Renvoie une clé de la superglobale, 
     * telle qu'elle était au moment de l'instanciation. 
     *
     * @param $key
     * @return mixed
     */
    public function get_SERVER($key = null)
    {
        if (null !== $key) {
            return (isset($this->_SERVER["$key"])) ? $this->_SERVER["$key"] : null;
        } else {
            return $this->_SERVER;
        }
    }
    /**
     * Returns a key from the superglobal,
     * as it was at the time of instantiation.
     * FR:
     * Renvoie une clé de la superglobale, 
     * telle qu'elle était au moment de l'instanciation. 
     *
     * @param $key
     * @return mixed
     */
    public function get_POST($key = null)
    {
        if (null !== $key) {
            return (isset($this->_POST["$key"])) ? $this->_POST["$key"] : null;
        } else {
            return $this->_POST;
        }
    }
    /**
     * Returns a key from the superglobal,
     * as it was at the time of instantiation.
     * FR:
     * Renvoie une clé de la superglobale, 
     * telle qu'elle était au moment de l'instanciation. 
     *
     * @param $key
     * @return mixed
     */
    public function get_GET($key = null)
    {
        if (null !== $key) {
            return (isset($this->_GET["$key"])) ? $this->_GET["$key"] : null;
        } else {
            return $this->_GET;
        }
    }
    /**
     * Returns a key from the superglobal,
     * as it was at the time of instantiation.
     * FR:
     * Renvoie une clé de la superglobale, 
     * telle qu'elle était au moment de l'instanciation
     *
     * @param $key
     * @return mixed
     */
    public function get_SESSION($key = null)
    {
        if (null !== $key) {
            return (isset($this->_SESSION["$key"])) ? $this->_SESSION["$key"] : null;
        } else {
            return $this->_SESSION;
        }
    }
    /**
     * Function to define superglobals for use locally.
     * We do not automatically unset the superglobals after
     * defining them, since they might be used by other code.
     * FR:
     * Fonction pour définir les superglobales à utiliser localement. 
     * Nous ne désactivons pas automatiquement les superglobales après 
     * les avoir définies , car elles pourraient être utilisées par un autre code.
     *
     * @return mixed
     */
    private function defineSuperglobals()
    {

        // Store a local copy of the PHP superglobals
        // This should avoid dealing with the global scope directly
        // $this->_SERVER = $_SERVER;
        $this->_SERVER = (isset($_SERVER)) ? $_SERVER : null;
        $this->_POST = (isset($_POST)) ? $_POST : null;
        $this->_GET = (isset($_GET)) ? $_GET : null;
        $this->_SESSION = (isset($_SESSION)) ? $_SESSION : null;

    }
    /**
     * You may call this function from your compositioning root,
     * if you are sure superglobals will not be needed by
     * dependencies or outside of your own code.
     * FR:
     * Vous pouvez appeler cette fonction depuis votre racine de composition, 
     * si vous êtes sûr que les superglobales ne seront pas nécessaires 
     * par les dépendances ou en dehors de votre propre code.
     *
     * @return void
     */
    public function unsetSuperglobals()
    {
        unset($_SERVER);
        unset($_POST);
        unset($_GET);
        unset($_SESSION);
    }

}