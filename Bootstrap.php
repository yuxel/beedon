<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

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
