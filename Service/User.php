<?php

class Service_User{

    public function __construct(){
        $this->userTable = UserTable::getInstance();
    }

    private function _filterUser($userObject){
        $userObject->avatar = ""; //TODO
        $userObject->profileLink = ""; //TODO
        unset($userObject->status);
        unset($userObject->email);
        unset($userObject->password);
    }

    public function getUserById($id){
        $q = Doctrine_Query::create()
             ->select('u.*')
             ->from('User u')
             ->where("u.status = 'active'")
             ->andWhere("u.id = ", $id);

        $user = $q->execute()->toArray();
        $user = Util_Doctrine::toObject($user);

        return $user[0];
    }

    public function getActiveuserById($id){
        $user = $this->getUserById($id);
        $this->_filterUser($user);

        return $user;
    }
}
