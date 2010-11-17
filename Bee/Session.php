<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

/**
 * Session handler
 */


class Bee_Session extends Bee_Common_Singleton_Abstract{

    private $_sid;

    private $_namepace = "__default__";

    public function __construct(){}

    public function init($sessionId = null){
        if ( $sessionId ){
            $this->_setSessionId($sessionId);
        }

        session_start();

        return $this;
    }

    public function set($key, $value){
        $_SESSION[$this->_namepace][$key] = $value;
    }

    public function setAll($value){
        $_SESSION[$this->_namepace] = $value;
    }

    function remove($key){
        unset( $_SESSION[$this->_namepace][$key] );
    }

    function removeAll(){
        unset( $_SESSION[$this->_namepace] );
    }

    function flush(){
        unset ( $_SESSION );
    }



    public function get($key=null){
        $result = null;

        if ( $key ) {
            if ( isset($_SESSION[$this->_namepace][$key]) ) {
                $result = $_SESSION[$this->_namepace][$key];
            }
        }
        else {
            if ( isset($_SESSION[$this->_namepace]) ) {
                $result = (object) $_SESSION[$this->_namepace];
            }
        }

        return  $result;
    }

    private function _setSessionId($sessionId){
        $sessionId = md5($sessionId);
        session_id($sessionId);
    }

    public function getSessionId(){
        return session_id();
    }

    public function setNamespace($namespace){
        $this->_namepace = $namespace;
        return $this;
    }

}
