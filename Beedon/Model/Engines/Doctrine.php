<?php

class Beedon_Model_Engines_Doctrine {

    function __construct(){
        $autoLoader = Beedon_AutoLoader::getInstance();
        
        $autoLoader->addExternalSource("Doctrine", Config_Model::ENGINE_PATH);
        spl_autoload_register(array('Doctrine', 'autoload'));

        spl_autoload_register(array('Doctrine_Core', 'modelsAutoload'));

        $manager = Doctrine_Manager::getInstance(); 

        $manager->setAttribute(Doctrine::ATTR_MODEL_LOADING, Doctrine::MODEL_LOADING_CONSERVATIVE);
        $manager->setAttribute(Doctrine::ATTR_AUTO_ACCESSOR_OVERRIDE, 1);
        $manager->setAttribute(Doctrine::ATTR_AUTOLOAD_TABLE_CLASSES, 1);
        $manager->setAttribute(Doctrine::ATTR_USE_NATIVE_ENUM, 1);

        $conn = Doctrine_Manager::connection(Config_Model::DSN, 'doctrine');   

        Doctrine::loadModels(Config_Model::MODEL_PATH);   

        //Doctrine::generateModelsFromDb("Config_Model::MODEL_PATH", array("doctrine"), array("generateTableClasses" => true)); 

        $mesajlar = MesajlarTable::getInstance();
        $mesaj = $mesajlar->findOneById("18");

        $mesaj->mesaj_metni  = "deneme";
        $mesaj->save();

        var_dump($mesaj->mesaj_metni);
    }


}
