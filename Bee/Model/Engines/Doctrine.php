<?php

class Bee_Model_Engines_Doctrine {

    function __construct(){
        $autoLoader = Bee_AutoLoader::getInstance();
        
        $autoLoader->addExternalSource("Doctrine", Config_Model::ENGINE_PATH);
        $autoLoader->addNewHandler(array('Doctrine', 'autoload'));
        $autoLoader->addNewHandler(array('Doctrine_Core', 'modelsAutoload'));

        $manager = Doctrine_Manager::getInstance();

        $manager->setAttribute(Doctrine::ATTR_MODEL_LOADING, Doctrine::MODEL_LOADING_CONSERVATIVE);
        $manager->setAttribute(Doctrine::ATTR_AUTO_ACCESSOR_OVERRIDE, 1);
        $manager->setAttribute(Doctrine::ATTR_AUTOLOAD_TABLE_CLASSES, 1);
        $manager->setAttribute(Doctrine::ATTR_USE_NATIVE_ENUM, 1);

        $conn = Doctrine_Manager::connection(Config_Model::DSN);   

        Doctrine_Core::loadModels(Config_Model::MODEL_PATH);
    }


    function generateFromTable(){
        Doctrine::generateModelsFromDb(Config_Model::MODEL_PATH, array(), array("generateTableClasses" => true)); 
    }


}
