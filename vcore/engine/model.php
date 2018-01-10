<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class model {

    /**
     * Constructor
     *
     * @access public
     */
    function __construct()
    {
        //log_message('debug', "Model Class Initialized");
    }

    /**
     * __get
     *
     * Allows models to access CI's loaded classes using the same
     * syntax as controllers.
     *
     * @access private
     */
    function __get($key)
    {
        $CI =& get_instance();
        return $CI->$key;
    }
}