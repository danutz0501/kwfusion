<?php
namespace Fusion\Unit;

class Unit_Controller extends \Fusion\System\UnitController {

    public function index()
    {
        $this->view('welcome/index', $data = NULL);
    }

}