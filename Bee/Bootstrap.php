<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

/**
 * init Model/View and Controller
 */
class Bee_Bootstrap{

    private $_view;
    private $_model;
    private $_session;


    public function __construct(){
        $this->_currentTheme = "default";
       
        $this->_fileRoot = substr($_SERVER['SCRIPT_NAME'],0,-10);
        $this->_fileRoot = substr($_SERVER['SCRIPT_NAME'],0,-10);
        $this->_fileRootAbs = substr($_SERVER['SCRIPT_FILENAME'],0,-10);
        $this->_fileRootAbsPrefix = str_replace($this->_fileRoot, "", $this->_fileRootAbs);

        $this->_templatesDir = $this->_fileRoot . "/Templates/";
        $this->_templateDir = $this->_templatesDir . $this->_currentTheme;
        $this->_staticPath = $this->_templateDir . "/_static";
        $this->_langDir = $this->_fileRootAbsPrefix . $this->_templateDir . "/_lang";
        $this->_uri = $_SERVER['REQUEST_URI'];
        $explode = explode("?",$this->_uri);
        $this->_currentUrl = $explode[0];

        if ( strpos($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']) === 0 ) {
            $this->_fileWebRoot = $_SERVER['SCRIPT_NAME'];
        }
        else {
            $this->_fileWebRoot = $this->_fileRoot;
        }

        $this->_requestHandler = new Bee_Request_Handler();
    }


    public function initSession(){
        $this->_session = Bee_Session::getInstance();
        //$this->_session->init("This can be a remote key");
        $this->_session->init();

        return $this;
    }


    /**
     * Init model 
     */
    public function initModel() {
        $this->_model = Bee_Model::factory(Config_Model::ENGINE);
        //$this->_model->generateFromTable();
        return $this;
    }

    /**
     * Init translator
     */
    public function initTranslator(){

        $changeLang = $this->_requestHandler->getParameter("_lang");

        $session = Bee_Session::getInstance()->setNamespace("lang");

        if ( $changeLang ) {
            $session->set("current",$changeLang);
        }


        if( isset($session->get()->current) ){
            $this->_currentLang = $session->get()->current;
        }
        else {
            $this->_currentLang = "en";
        }


        

        $file = $this->_langDir ."/" . $this->_currentLang . ".php";
        include_once($file);
        $this->_lang = $_lang;

        return $this;
    }

    /**
     * Init View
     */
    public function initView() {
        $this->_view = Bee_View::factory(Config_View::ENGINE);
        $this->_view->assign("_l", $this->_lang);
        $this->_view->assign("_staticPath", $this->_staticPath);
        $this->_view->assign("_root",$this->_fileWebRoot);
        $this->_view->assign("_uri",$this->_uri);
        $this->_view->assign("_currentUrl",$this->_currentUrl);
        $this->_view->assign("_currentLang",$this->_currentLang);
        $this->_view->assign("_languages",Enum_Datas::getLanguages());

        $userData = Bee_Session::getInstance()->setNamespace("user")->get();
        $this->_view->assign("_userData", $userData);

        return $this;
    }

    /**
     * get controller and run action from requestHandler
     */
    public function initController(){
        $requestHandler = $this->_requestHandler;
        $actionArgs = null;
        try{
            $controllerAndAction = $requestHandler->getControllerAndAction();
            $controller = $controllerAndAction["controller"];
            $action     = $controllerAndAction["action"];
        }
        catch(Exception $e) {
            $controller = new Controller_Error();
            $action     = "showError";
            $actionArgs = $e->getMessage();
        }


        
        $controller->setSession($this->_session);
        $controller->setModel($this->_model);
        $controller->setRequestHandler($requestHandler);
        $controller->setView($this->_view);

        call_user_func(array($controller, $action), $actionArgs);

        $controller->renderView();

        return $this;
    }

} 
