<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class router {

    var $config;
    var $routes            = array();
    var $module = '';
    var $error_routes    = array();
    var $class            = '';
    var $method            = 'index';
    var $directory        = '';
    var $default_controller;

    function __construct()
    {
        
        $this->config =& load_class('config', 'library');
        $this->uri =& load_class('uri', 'library');
        $this->muti_language = $this->config->item('muti_language');
    }

    function _set_routing()
    {
        //var_dump($this->config);

        // Are query strings enabled in the config file?  Normally CI doesn't utilize query strings
        // since URI segments are more search-engine friendly, but they can optionally be used.
        // If this feature is enabled, we will gather the directory/class/method a little differently
        $segments = array();
        if ($this->config->item('enable_query_strings') === TRUE AND isset($_GET[$this->config->item('controller_trigger')]))
        {
            if (isset($_GET[$this->config->item('directory_trigger')]))
            {
                $this->set_directory(trim($this->uri->_filter_uri($_GET[$this->config->item('directory_trigger')])));
                $segments[] = $this->fetch_directory();
            }

            if (isset($_GET[$this->config->item('controller_trigger')]))
            {
                $this->set_class(trim($this->uri->_filter_uri($_GET[$this->config->item('controller_trigger')])));
                $segments[] = $this->fetch_class();
            }

            if (isset($_GET[$this->config->item('function_trigger')]))
            {
                $this->set_method(trim($this->uri->_filter_uri($_GET[$this->config->item('function_trigger')])));
                $segments[] = $this->fetch_method();
            }
        }

        // Load the routes.php file.
        if (defined('ENVIRONMENT') AND is_file(APPPATH.'config/'.ENVIRONMENT.'/routes'.EXT))
        {
            include(APPPATH.'config/'.ENVIRONMENT.'/routes'.EXT);
        }
        elseif (is_file(APPPATH.'config/routes'.EXT))
        {
            include(APPPATH.'config/routes'.EXT);
        }
        
        $this->routes = ( ! isset($route) OR ! is_array($route)) ? array() : $route;
        unset($route);

        // Set the default controller so we can display it in the event
        // the URI doesn't correlated to a valid controller.
        $this->default_controller = ( ! isset($this->routes['default_controller']) OR $this->routes['default_controller'] == '') ? FALSE : strtolower($this->routes['default_controller']);

        // Were there any query string segments?  If so, we'll validate them and bail out since we're done.
        
        if (count($segments) > 0)
        {

            return $this->_validate_request($segments);
        }

        // Fetch the complete URI string
        $this->uri->_fetch_uri_string();

        // Is there a URI string? If not, the default controller specified in the "routes" file will be shown.
        if ($this->uri->uri_string == '')
        {
            return $this->_set_default_controller();
        }
        


        // Do we need to remove the URL suffix?
        $this->uri->_remove_url_suffix();

        // Compile the segments into an array
        $this->uri->_explode_segments();

        // Parse any custom routing that may exist
        $this->_parse_routes();

        // Re-index the segment array so that it starts with 1 rather than 0
        $this->uri->_reindex_segments();
    }

    // --------------------------------------------------------------------

    function _set_default_controller()
    {
        
        if ($this->default_controller === FALSE)
        {
            show_error("Unable to determine what should be displayed. A default route has not been specified in the routing file.");
        }
        // Is the method being specified?
        if (strpos($this->default_controller, '/') !== FALSE)
        {
            $x = explode('/', $this->default_controller);

            $this->set_class($x[0]);
            $this->set_method($x[1]);
            $this->_set_request($x);
        }
        else
        {
            $this->set_class($this->default_controller);
            $this->set_method('index');
            $this->_set_request(array($this->default_controller, 'index'));

        }

        // re-index the routed segments array so it starts with 1 rather than 0
        $this->uri->_reindex_segments();

        log_message('debug', "No URI present. Default controller set.");
    }

    // --------------------------------------------------------------------


    function _set_request($segments = array())
    {
        $segments = $this->_validate_request($segments);
        //var_dump($segments);
        if (count($segments) == 0)
        {
            return $this->_set_default_controller();
        }

        $this->set_class($segments[0]);

        if (isset($segments[1]))
        {
            // A standard method request
            
            $this->set_method($segments[1]);
        }
        else
        {
            // This lets the "routed" segment array identify that the default
            // index method is being used.
            $segments[1] = 'index';
        }

        // Update our "routed" segment array to contain the segments.
        // Note: If there is no custom routing, this array will be
        // identical to $this->uri->segments
        $this->uri->rsegments = $segments;
    }

    // --------------------------------------------------------------------

    function _validate_request($segments)
    {

        //var_dump($segments);
        if (count($segments) == 0)
        {
            return $segments;
        }

        // Is the controller in a sub-folder?
        if (file_exists(APPPATH.'modules/'.$segments[0].'/'.$segments[1].EXT))
        {

            // Set the directory and remove it from the segment array
            $this->module = $segments[0];
            $this->set_directory($segments[0]);
            $segments = array_slice($segments, 1);

            if (count($segments) > 0)
            {
                // Does the requested controller exist in the sub-folder?
                if ( ! file_exists(APPPATH.'modules/'.$this->fetch_directory().$segments[0].EXT))
                {
                    show_404($this->fetch_directory().$segments[0].' - ERROR SUB Controller');
                }
            }
            else
            {
                // Is the method being specified in the route?
                if (strpos($this->default_controller, '/') !== FALSE)
                {
                    $x = explode('/', $this->default_controller);

                    $this->set_class($x[0]);
                    $this->set_method($x[1]);
                }
                else
                {
                    $this->set_class($this->default_controller);
                    $this->set_method('index');
                }

                // Does the default controller exist in the sub-folder?
                if ( ! file_exists(APPPATH.'modules/'.$this->fetch_directory().$this->default_controller.EXT))
                {
                    $this->directory = '';
                    return array();
                }

            }

            return $segments;
        }
        
        // Does the requested controller exist in the root folder?
        if (file_exists(APPPATH.'modules/'.$segments[0].'/'.$segments[0].EXT))
        {
            $this->set_directory($segments[0]);
            $this->module = $segments[0];
            return $segments;
        } 


        // If we've gotten this far it means that the URI does not correlate to a valid
        // controller class.  We will now see if there is an override
        if ( ! empty($this->routes['404_override']))
        {
            $x = explode('/', $this->routes['404_override']);

            $this->set_class($x[0]);
            $this->set_method(isset($x[1]) ? $x[1] : 'index');

            return $x;
        }


        // Nothing else to do at this point but show a 404
        show_404($segments[0].' - Error');
    }
    


    // --------------------------------------------------------------------

    function _parse_routes()
    {
        
        // Turn the segment array into a URI string
        $uri = implode('/', $this->uri->segments);

        // Is there a literal match?  If so we're done
        if (isset($this->routes[$uri]))
        {
            return $this->_set_request(explode('/', $this->routes[$uri]));
        }

        // Loop through the route array looking for wild-cards
        
        foreach ($this->routes as $key => $val)
        {
           
           //echo '<b>'.$key.'</b><br />';
            // Convert wild-cards to RegEx
            //$key = 'vi/'.$key;
            $key = str_replace(':any', '.+', str_replace(':num', '[0-9]+', $key));
            //echo $key.'<br />';
            // Does the RegEx match?
            if (preg_match('#^'.$key.'$#', $uri))
            {
                // Do we have a back-reference?
                if (strpos($val, '$') !== FALSE AND strpos($key, '(') !== FALSE)
                {
                    $val = preg_replace('#^'.$key.'$#', $val, $uri);
                    //echo 'Key: '.$val.'<br />';
                }

                return $this->_set_request(explode('/', $val));
            }
        }

        // If we got this far it means we didn't encounter a
        // matching route so we'll set the site default route
        $this->_set_request($this->uri->segments);
    }

    // --------------------------------------------------------------------

    function set_class($class)
    {
        $this->class = str_replace(array('/', '.'), '', $class);
    }

    // --------------------------------------------------------------------

    function fetch_module_path(){
      
        
        return APP_ROOT.'modules/'.$this->module.'/';
    }
    
    // --------------------------------------------------------------------

    function fetch_module(){
        return $this->module;
    }
    
    // --------------------------------------------------------------------
    
    function fetch_class()
    {
        return $this->class;
    }

    // --------------------------------------------------------------------

    function set_method($method)
    {
        $this->method = $method;
    }

    // --------------------------------------------------------------------

    function fetch_method()
    {
        if ($this->method == $this->fetch_class())
        {
            return 'index';
        }

        return $this->method;
    }

    // --------------------------------------------------------------------

    function set_directory($dir)
    {
        $this->directory = str_replace(array('/', '.'), '', $dir).'/';
    }

    // --------------------------------------------------------------------

    function fetch_directory()
    {
        return $this->directory;
    }

    // --------------------------------------------------------------------

    function _set_overrides($routing)
    {
        if ( ! is_array($routing))
        {
            return;
        }

        if (isset($routing['directory']))
        {
            $this->set_directory($routing['directory']);
        }

        if (isset($routing['controller']) AND $routing['controller'] != '')
        {
            $this->set_class($routing['controller']);
        }

        if (isset($routing['function']))
        {
            $routing['function'] = ($routing['function'] == '') ? 'index' : $routing['function'];
            $this->set_method($routing['function']);
        }
    }
}
