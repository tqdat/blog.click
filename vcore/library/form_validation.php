<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class form_validation {

    var $CI;
    var $_field_data            = array();
    var $_config_rules            = array();
    var $_error_array            = array();
    var $_error_messages        = array();
    var $_error_prefix            = '<p class="error">';
    var $_error_suffix            = '</p>';
    var $error_string            = '';
    var $_safe_form_data        = FALSE;


    /**
     * Constructor
     */
    public function __construct($rules = array())
    {
        $this->CI =& get_instance();

        // Validation rules can be stored in a config file.
        $this->_config_rules = $rules;

        // Automatically load the form helper
        $this->CI->load->helper('form');

        // Set the character encoding in MB.
        if (function_exists('mb_internal_encoding'))
        {
            mb_internal_encoding($this->CI->config->item('charset'));
        }
    }

    // --------------------------------------------------------------------

    function set_rules($field, $label = '', $rules = '')
    {
        // No reason to set rules if we have no POST data
        if (count($_POST) == 0)
        {
            return $this;
        }

        // If an array was passed via the first parameter instead of indidual string
        // values we cycle through it and recursively call this function.
        if (is_array($field))
        {
            foreach ($field as $row)
            {
                // Houston, we have a problem...
                if ( ! isset($row['field']) OR ! isset($row['rules']))
                {
                    continue;
                }

                // If the field label wasn't passed we use the field name
                $label = ( ! isset($row['label'])) ? $row['field'] : $row['label'];

                // Here we go!
                $this->set_rules($row['field'], $label, $row['rules']);
            }
            return $this;
        }

        // No fields? Nothing to do...
        if ( ! is_string($field) OR  ! is_string($rules) OR $field == '')
        {
            return $this;
        }

        // If the field label wasn't passed we use the field name
        $label = ($label == '') ? $field : $label;

        // Is the field name an array?  We test for the existence of a bracket "[" in
        // the field name to determine this.  If it is an array, we break it apart
        // into its components so that we can fetch the corresponding POST data later
        if (strpos($field, '[') !== FALSE AND preg_match_all('/\[(.*?)\]/', $field, $matches))
        {
            // Note: Due to a bug in current() that affects some versions
            // of PHP we can not pass function call directly into it
            $x = explode('[', $field);
            $indexes[] = current($x);

            for ($i = 0; $i < count($matches['0']); $i++)
            {
                if ($matches['1'][$i] != '')
                {
                    $indexes[] = $matches['1'][$i];
                }
            }

            $is_array = TRUE;
        }
        else
        {
            $indexes    = array();
            $is_array    = FALSE;
        }

        // Build our master array
        $this->_field_data[$field] = array(
            'field'                => $field,
            'label'                => $label,
            'rules'                => $rules,
            'is_array'            => $is_array,
            'keys'                => $indexes,
            'postdata'            => NULL,
            'error'                => ''
        );

        return $this;
    }

    // --------------------------------------------------------------------

    function set_message($lang, $val = '')
    {
        if ( ! is_array($lang))
        {
            $lang = array($lang => $val);
        }

        $this->_error_messages = array_merge($this->_error_messages, $lang);

        return $this;
    }

    // --------------------------------------------------------------------

    function set_error_delimiters($prefix = '<p class="error">', $suffix = '</p>')
    {
        $this->_error_prefix = $prefix;
        $this->_error_suffix = $suffix;

        return $this;
    }

    // --------------------------------------------------------------------

    function error($field = '', $prefix = '', $suffix = '')
    {
        if ( ! isset($this->_field_data[$field]['error']) OR $this->_field_data[$field]['error'] == '')
        {
            return '';
        }

        if ($prefix == '')
        {
            $prefix = $this->_error_prefix;
        }

        if ($suffix == '')
        {
            $suffix = $this->_error_suffix;
        }

        return $prefix.$this->_field_data[$field]['error'].$suffix;
    }

    // --------------------------------------------------------------------

    function error_string($prefix = '', $suffix = '')
    {
        // No errrors, validation passes!
        if (count($this->_error_array) === 0)
        {
            return '';
        }

        if ($prefix == '')
        {
            $prefix = $this->_error_prefix;
        }

        if ($suffix == '')
        {
            $suffix = $this->_error_suffix;
        }

        // Generate the error string
        $str = '';
        foreach ($this->_error_array as $val)
        {
            if ($val != '')
            {
                $str .= $prefix.$val.$suffix."\n";
            }
        }

        return $str;
    }

    // --------------------------------------------------------------------

    function run($group = '')
    {
        // Do we even have any data to process?  Mm?
        if (count($_POST) == 0)
        {
            return FALSE;
        }

        // Does the _field_data array containing the validation rules exist?
        // If not, we look to see if they were assigned via a config file
        if (count($this->_field_data) == 0)
        {
            // No validation rules?  We're done...
            if (count($this->_config_rules) == 0)
            {
                return FALSE;
            }

            // Is there a validation rule for the particular URI being accessed?
            $uri = ($group == '') ? trim($this->CI->uri->ruri_string(), '/') : $group;

            if ($uri != '' AND isset($this->_config_rules[$uri]))
            {
                $this->set_rules($this->_config_rules[$uri]);
            }
            else
            {
                $this->set_rules($this->_config_rules);
            }

            // We're we able to set the rules correctly?
            if (count($this->_field_data) == 0)
            {
                log_message('debug', "Unable to find validation rules");
                return FALSE;
            }
        }

        // Load the language file containing error messages
        $this->CI->lang->load('form_validation');

        // Cycle through the rules for each field, match the
        // corresponding $_POST item and test for errors
        foreach ($this->_field_data as $field => $row)
        {
            // Fetch the data from the corresponding $_POST array and cache it in the _field_data array.
            // Depending on whether the field name is an array or a string will determine where we get it from.

            if ($row['is_array'] == TRUE)
            {
                $this->_field_data[$field]['postdata'] = $this->_reduce_array($_POST, $row['keys']);
            }
            else
            {
                if (isset($_POST[$field]) AND $_POST[$field] != "")
                {
                    $this->_field_data[$field]['postdata'] = $_POST[$field];
                }
            }

            $this->_execute($row, explode('|', $row['rules']), $this->_field_data[$field]['postdata']);
        }

        // Did we end up with any errors?
        $total_errors = count($this->_error_array);

        if ($total_errors > 0)
        {
            $this->_safe_form_data = TRUE;
        }

        // Now we need to re-set the POST data with the new, processed data
        $this->_reset_post_array();

        // No errors, validation passes!
        if ($total_errors == 0)
        {
            return TRUE;
        }

        // Validation fails
        return FALSE;
    }

    // --------------------------------------------------------------------

    function _reduce_array($array, $keys, $i = 0)
    {
        if (is_array($array))
        {
            if (isset($keys[$i]))
            {
                if (isset($array[$keys[$i]]))
                {
                    $array = $this->_reduce_array($array[$keys[$i]], $keys, ($i+1));
                }
                else
                {
                    return NULL;
                }
            }
            else
            {
                return $array;
            }
        }

        return $array;
    }

    // --------------------------------------------------------------------

    function _reset_post_array()
    {
        foreach ($this->_field_data as $field => $row)
        {
            if ( ! is_null($row['postdata']))
            {
                if ($row['is_array'] == FALSE)
                {
                    if (isset($_POST[$row['field']]))
                    {
                        $_POST[$row['field']] = $this->prep_for_form($row['postdata']);
                    }
                }
                else
                {
                    // start with a reference
                    $post_ref =& $_POST;

                    // before we assign values, make a reference to the right POST key
                    if (count($row['keys']) == 1)
                    {
                        $post_ref =& $post_ref[current($row['keys'])];
                    }
                    else
                    {
                        foreach ($row['keys'] as $val)
                        {
                            $post_ref =& $post_ref[$val];
                        }
                    }

                    if (is_array($row['postdata']))
                    {
                        $array = array();
                        foreach ($row['postdata'] as $k => $v)
                        {
                            $array[$k] = $this->prep_for_form($v);
                        }

                        $post_ref = $array;
                    }
                    else
                    {
                        $post_ref = $this->prep_for_form($row['postdata']);
                    }
                }
            }
        }
    }

    // --------------------------------------------------------------------

    function _execute($row, $rules, $postdata = NULL, $cycles = 0)
    {
        // If the $_POST data is an array we will run a recursive call
        if (is_array($postdata))
        {
            foreach ($postdata as $key => $val)
            {
                $this->_execute($row, $rules, $val, $cycles);
                $cycles++;
            }

            return;
        }

        // --------------------------------------------------------------------

        // If the field is blank, but NOT required, no further tests are necessary
        $callback = FALSE;
        if ( ! in_array('required', $rules) AND is_null($postdata))
        {
            // Before we bail out, does the rule contain a callback?
            if (preg_match("/(callback_\w+)/", implode(' ', $rules), $match))
            {
                $callback = TRUE;
                $rules = (array('1' => $match[1]));
            }
            else
            {
                return;
            }
        }

        // --------------------------------------------------------------------

        // Isset Test. Typically this rule will only apply to checkboxes.
        if (is_null($postdata) AND $callback == FALSE)
        {
            if (in_array('isset', $rules, TRUE) OR in_array('required', $rules))
            {
                // Set the message type
                $type = (in_array('required', $rules)) ? 'required' : 'isset';

                if ( ! isset($this->_error_messages[$type]))
                {
                    if (FALSE === ($line = $this->CI->lang->line($type)))
                    {
                        $line = 'The field was not set';
                    }
                }
                else
                {
                    $line = $this->_error_messages[$type];
                }

                // Build the error message
                $message = sprintf($line, $this->_translate_fieldname($row['label']));

                // Save the error message
                $this->_field_data[$row['field']]['error'] = $message;

                if ( ! isset($this->_error_array[$row['field']]))
                {
                    $this->_error_array[$row['field']] = $message;
                }
            }

            return;
        }

        // --------------------------------------------------------------------

        // Cycle through each rule and run it
        foreach ($rules As $rule)
        {
            $_in_array = FALSE;

            // We set the $postdata variable with the current data in our master array so that
            // each cycle of the loop is dealing with the processed data from the last cycle
            if ($row['is_array'] == TRUE AND is_array($this->_field_data[$row['field']]['postdata']))
            {
                // We shouldn't need this safety, but just in case there isn't an array index
                // associated with this cycle we'll bail out
                if ( ! isset($this->_field_data[$row['field']]['postdata'][$cycles]))
                {
                    continue;
                }

                $postdata = $this->_field_data[$row['field']]['postdata'][$cycles];
                $_in_array = TRUE;
            }
            else
            {
                $postdata = $this->_field_data[$row['field']]['postdata'];
            }

            // --------------------------------------------------------------------

            // Is the rule a callback?
            $callback = FALSE;
            if (substr($rule, 0, 9) == 'callback_')
            {
                $rule = substr($rule, 9);
                $callback = TRUE;
            }

            // Strip the parameter (if exists) from the rule
            // Rules can contain a parameter: max_length[5]
            $param = FALSE;
            if (preg_match("/(.*?)\[(.*)\]/", $rule, $match))
            {
                $rule    = $match[1];
                $param    = $match[2];
            }

            // Call the function that corresponds to the rule
            if ($callback === TRUE)
            {
                if ( ! method_exists($this->CI, $rule))
                {
                    continue;
                }

                // Run the function and grab the result
                $result = $this->CI->$rule($postdata, $param);

                // Re-assign the result to the master data array
                if ($_in_array == TRUE)
                {
                    $this->_field_data[$row['field']]['postdata'][$cycles] = (is_bool($result)) ? $postdata : $result;
                }
                else
                {
                    $this->_field_data[$row['field']]['postdata'] = (is_bool($result)) ? $postdata : $result;
                }

                // If the field isn't required and we just processed a callback we'll move on...
                if ( ! in_array('required', $rules, TRUE) AND $result !== FALSE)
                {
                    continue;
                }
            }
            else
            {
                if ( ! method_exists($this, $rule))
                {
                    // If our own wrapper function doesn't exist we see if a native PHP function does.
                    // Users can use any native PHP function call that has one param.
                    if (function_exists($rule))
                    {
                        $result = $rule($postdata);

                        if ($_in_array == TRUE)
                        {
                            $this->_field_data[$row['field']]['postdata'][$cycles] = (is_bool($result)) ? $postdata : $result;
                        }
                        else
                        {
                            $this->_field_data[$row['field']]['postdata'] = (is_bool($result)) ? $postdata : $result;
                        }
                    }

                    continue;
                }

                $result = $this->$rule($postdata, $param);

                if ($_in_array == TRUE)
                {
                    $this->_field_data[$row['field']]['postdata'][$cycles] = (is_bool($result)) ? $postdata : $result;
                }
                else
                {
                    $this->_field_data[$row['field']]['postdata'] = (is_bool($result)) ? $postdata : $result;
                }
            }

            // Did the rule test negatively?  If so, grab the error.
            if ($result === FALSE)
            {
                if ( ! isset($this->_error_messages[$rule]))
                {
                    if (FALSE === ($line = $this->CI->lang->line($rule)))
                    {
                        $line = 'Unable to access an error message corresponding to your field name.';
                    }
                }
                else
                {
                    $line = $this->_error_messages[$rule];
                }

                // Is the parameter we are inserting into the error message the name
                // of another field?  If so we need to grab its "field label"
                if (isset($this->_field_data[$param]) AND isset($this->_field_data[$param]['label']))
                {
                    $param = $this->_translate_fieldname($this->_field_data[$param]['label']);
                }

                // Build the error message
                $message = sprintf($line, $this->_translate_fieldname($row['label']), $param);

                // Save the error message
                $this->_field_data[$row['field']]['error'] = $message;

                if ( ! isset($this->_error_array[$row['field']]))
                {
                    $this->_error_array[$row['field']] = $message;
                }

                return;
            }
        }
    }

    // --------------------------------------------------------------------

    function _translate_fieldname($fieldname)
    {
        // Do we need to translate the field name?
        // We look for the prefix lang: to determine this
        if (substr($fieldname, 0, 5) == 'lang:')
        {
            // Grab the variable
            $line = substr($fieldname, 5);

            // Were we able to translate the field name?  If not we use $line
            if (FALSE === ($fieldname = $this->CI->lang->line($line)))
            {
                return $line;
            }
        }

        return $fieldname;
    }

    // --------------------------------------------------------------------

    function set_value($field = '', $default = '')
    {
        if ( ! isset($this->_field_data[$field]))
        {
            return $default;
        }

        // If the data is an array output them one at a time.
        //     E.g: form_input('name[]', set_value('name[]');
        if (is_array($this->_field_data[$field]['postdata']))
        {
            return array_shift($this->_field_data[$field]['postdata']);
        }

        return $this->_field_data[$field]['postdata'];
    }

    // --------------------------------------------------------------------

    function set_select($field = '', $value = '', $default = FALSE)
    {
        if ( ! isset($this->_field_data[$field]) OR ! isset($this->_field_data[$field]['postdata']))
        {
            if ($default === TRUE AND count($this->_field_data) === 0)
            {
                return ' selected="selected"';
            }
            return '';
        }

        $field = $this->_field_data[$field]['postdata'];

        if (is_array($field))
        {
            if ( ! in_array($value, $field))
            {
                return '';
            }
        }
        else
        {
            if (($field == '' OR $value == '') OR ($field != $value))
            {
                return '';
            }
        }

        return ' selected="selected"';
    }

    // --------------------------------------------------------------------

    function set_radio($field = '', $value = '', $default = FALSE)
    {
        if ( ! isset($this->_field_data[$field]) OR ! isset($this->_field_data[$field]['postdata']))
        {
            if ($default === TRUE AND count($this->_field_data) === 0)
            {
                return ' checked="checked"';
            }
            return '';
        }

        $field = $this->_field_data[$field]['postdata'];

        if (is_array($field))
        {
            if ( ! in_array($value, $field))
            {
                return '';
            }
        }
        else
        {
            if (($field == '' OR $value == '') OR ($field != $value))
            {
                return '';
            }
        }

        return ' checked="checked"';
    }

    // --------------------------------------------------------------------

    function set_checkbox($field = '', $value = '', $default = FALSE)
    {
        if ( ! isset($this->_field_data[$field]) OR ! isset($this->_field_data[$field]['postdata']))
        {
            if ($default === TRUE AND count($this->_field_data) === 0)
            {
                return ' checked="checked"';
            }
            return '';
        }

        $field = $this->_field_data[$field]['postdata'];

        if (is_array($field))
        {
            if ( ! in_array($value, $field))
            {
                return '';
            }
        }
        else
        {
            if (($field == '' OR $value == '') OR ($field != $value))
            {
                return '';
            }
        }

        return ' checked="checked"';
    }

    // --------------------------------------------------------------------

    function required($str)
    {
        if ( ! is_array($str))
        {
            return (trim($str) == '') ? FALSE : TRUE;
        }
        else
        {
            return ( ! empty($str));
        }
    }

    // --------------------------------------------------------------------

    function regex_match($str, $regex)
    {
        if ( ! preg_match($regex, $str))
        {
            return FALSE;
        }

        return  TRUE;
    }

    // --------------------------------------------------------------------

    function matches($str, $field)
    {
        if ( ! isset($_POST[$field]))
        {
            return FALSE;
        }

        $field = $_POST[$field];

        return ($str !== $field) ? FALSE : TRUE;
    }

    // --------------------------------------------------------------------

    function min_length($str, $val)
    {
        if (preg_match("/[^0-9]/", $val))
        {
            return FALSE;
        }

        if (function_exists('mb_strlen'))
        {
            return (mb_strlen($str) < $val) ? FALSE : TRUE;
        }

        return (strlen($str) < $val) ? FALSE : TRUE;
    }

    // --------------------------------------------------------------------

    function max_length($str, $val)
    {
        if (preg_match("/[^0-9]/", $val))
        {
            return FALSE;
        }

        if (function_exists('mb_strlen'))
        {
            return (mb_strlen($str) > $val) ? FALSE : TRUE;
        }

        return (strlen($str) > $val) ? FALSE : TRUE;
    }

    // --------------------------------------------------------------------

    function exact_length($str, $val)
    {
        if (preg_match("/[^0-9]/", $val))
        {
            return FALSE;
        }

        if (function_exists('mb_strlen'))
        {
            return (mb_strlen($str) != $val) ? FALSE : TRUE;
        }

        return (strlen($str) != $val) ? FALSE : TRUE;
    }

    // --------------------------------------------------------------------

    function valid_email($str)
    {
        return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
    }

    // --------------------------------------------------------------------

    function valid_emails($str)
    {
        if (strpos($str, ',') === FALSE)
        {
            return $this->valid_email(trim($str));
        }

        foreach (explode(',', $str) as $email)
        {
            if (trim($email) != '' && $this->valid_email(trim($email)) === FALSE)
            {
                return FALSE;
            }
        }

        return TRUE;
    }

    // --------------------------------------------------------------------

    function valid_ip($ip)
    {
        return $this->CI->input->valid_ip($ip);
    }

    // --------------------------------------------------------------------

    function alpha($str)
    {
        return ( ! preg_match("/^([a-z])+$/i", $str)) ? FALSE : TRUE;
    }

    // --------------------------------------------------------------------

    function alpha_numeric($str)
    {
        return ( ! preg_match("/^([a-z0-9])+$/i", $str)) ? FALSE : TRUE;
    }

    // --------------------------------------------------------------------

    function alpha_dash($str)
    {
        return ( ! preg_match("/^([-a-z0-9_-])+$/i", $str)) ? FALSE : TRUE;
    }

    // --------------------------------------------------------------------

    function numeric($str)
    {
        return (bool)preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/', $str);

    }

    // --------------------------------------------------------------------

    function is_numeric($str)
    {
        return ( ! is_numeric($str)) ? FALSE : TRUE;
    }

    // --------------------------------------------------------------------

    function integer($str)
    {
        return (bool) preg_match('/^[\-+]?[0-9]+$/', $str);
    }

    // --------------------------------------------------------------------


    function decimal($str)
    {
        return (bool) preg_match('/^[\-+]?[0-9]+\.[0-9]+$/', $str);
    }

    // --------------------------------------------------------------------

    function greater_than($str, $min)
    {
        if ( ! is_numeric($str))
        {
            return FALSE;
        }
        return $str > $min;
    }

    // --------------------------------------------------------------------

    function less_than($str, $max)
    {
        if ( ! is_numeric($str))
        {
            return FALSE;
        }
        return $str < $max;
    }

    // --------------------------------------------------------------------

    function is_natural($str)
    {
        return (bool) preg_match( '/^[0-9]+$/', $str);
    }

    // --------------------------------------------------------------------

    function is_natural_no_zero($str)
    {
        if ( ! preg_match( '/^[0-9]+$/', $str))
        {
            return FALSE;
        }

        if ($str == 0)
        {
            return FALSE;
        }

        return TRUE;
    }

    // --------------------------------------------------------------------

    function valid_base64($str)
    {
        return (bool) ! preg_match('/[^a-zA-Z0-9\/\+=]/', $str);
    }

    // --------------------------------------------------------------------

    function prep_for_form($data = '')
    {
        if (is_array($data))
        {
            foreach ($data as $key => $val)
            {
                $data[$key] = $this->prep_for_form($val);
            }

            return $data;
        }

        if ($this->_safe_form_data == FALSE OR $data === '')
        {
            return $data;
        }

        return str_replace(array("'", '"', '<', '>'), array("&#39;", "&quot;", '&lt;', '&gt;'), stripslashes($data));
    }

    // --------------------------------------------------------------------

    function prep_url($str = '')
    {
        if ($str == 'http://' OR $str == '')
        {
            return '';
        }

        if (substr($str, 0, 7) != 'http://' && substr($str, 0, 8) != 'https://')
        {
            $str = 'http://'.$str;
        }

        return $str;
    }

    // --------------------------------------------------------------------

    function strip_image_tags($str)
    {
        return $this->CI->input->strip_image_tags($str);
    }

    // --------------------------------------------------------------------

    function xss_clean($str)
    {
        return $this->CI->security->xss_clean($str);
    }

    // --------------------------------------------------------------------

    function encode_php_tags($str)
    {
        return str_replace(array('<?php', '<?PHP', '<?', '?>'),  array('&lt;?php', '&lt;?PHP', '&lt;?', '?&gt;'), $str);
    }

}
