<?php

class Controller_Test extends Bee_Controller_Abstract{
    //this will run when called test/index
    function index(){
        $userService = new Service_User();


        $userToLog = new User();
        $userToLog->username = "yuxel";
        $userToLog->password = "foo";

        $login = $userService->login($userToLog);

        if ( $login == false ) {
            $userService->register($userToLog);
        }

        var_dump($login);
    

        $parameters = $this->getParameters();
        $this->view->assign("someVariable",$parameters);
    }

    //this will run when called test/bar
    function fooBar(){
        //set view file instead of action's view
        $this->setViewFile("test/index");


        //this will look for a "bar" parameter for request
        //POST > GET > URI
        $parameter = $this->getParameter("bar");


        $this->view->assign("someVariable",$parameter);
    }

    //this will run on any other action
    function __call($method, $argds){
        //set view file instead of action's view
        $this->setViewFile("test/index");

        $message = "This will catch all other actions";
        $this->view->assign("someVariable", $message);
    }
}
