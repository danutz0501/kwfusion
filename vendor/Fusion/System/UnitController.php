<?php
namespace Fusion\System;

/**
 * Class UnitController
 * @package Fusion\System
 *
 * Base class for Unit testing
 */
class UnitController extends SystemController {

	public $testname;

	public function __construct() {

		//$this->testname = new \PHPUnit_Framework_TestCase;
	}

}