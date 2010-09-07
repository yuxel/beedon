<?php

class Service_User{
    public function login(User $user) {
        $userTable = UserTable::getInstance();
        $foundUser = $userTable->findOneByUsername($user->username);
        if ( $foundUser && $foundUser->password == $user->password ) {
            return true;
        }

        return false;
    }

    public function register(User $user) {
        unset($user->id);
        $user->save();
    }

    

}
