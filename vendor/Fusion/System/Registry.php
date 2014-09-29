<?php
/**
 * The Application class will act as a registry and dependency injector
 * for the system's crucial files.
 */

class Application {

    protected static $registry = array();
 
    /**
     * Add a new resolver to the registry array.
     * @param  string $name The id
     * @param  object $resolve Closure that creates instance
     * @return void
     */
    public static function register($name, Closure $resolve) {
		
        static::$registry[$name] = $resolve;
    }
 
    /**
     * Create the instance
     * @param  string $name The id
     * @return mixed
     */
    public static function run($name) {
		
        if ( static::registered($name) ) {
			
            $name = static::$registry[$name];
            return $name();
        }
 
        throw new Exception($name. ' not found');
    }
 
    /**
     * Determine whether the id is registered
     * @param  string $name The id
     * @return bool Whether to id exists or not
     */
    public static function registered($name) {
		
        return array_key_exists($name, static::$registry);
    }
}

/**
 * The Toolbox class is nearly identical to the Application class.
 * It's purpose is to provide a common interface for the Toolbox,
 * and instantiating the classes automatically as needed.
 */

class Toolbox {

    protected static $registry = array();
 
    /**
     * Add a new resolver to the registry array.
     * @param  string $name The id
     * @param  object $resolve Closure that creates instance
     * @return void
     */
    public static function register($name, Closure $resolve) {
		
        static::$registry[$name] = $resolve;
    }
 
    /**
     * Create the instance
     * @param  string $name The id
     * @return mixed
     */
    public static function helper($name) {
		
        if ( static::registered($name) ) {
			
            $name = static::$registry[$name];
            return $name();
        }
 
        throw new Exception('Toolbox helper <strong>'. $name. '</strong> not registered.');
    }
 
    /**
     * Determine whether the id is registered
     * @param  string $name The id
     * @return bool Whether to id exists or not
     */
    public static function registered($name) {
		
        return array_key_exists($name, static::$registry);
    }
}