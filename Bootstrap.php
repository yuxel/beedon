<?php

/**
 * init Model/View and Controller
 */
class Bootstrap{

    public function initModel() {
        return $this;
    }


    /**
     * Init View
     */
    public function initView() {
        $this->view = View::factory(Config_View::ENGINE);
        return $this;
    }

    public function initController(){

        return $this;
    }

    public function initUrlMapper() {

        return $this;
    }
}
