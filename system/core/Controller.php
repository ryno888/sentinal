<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2017, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2017, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;
	private $meta_arr = [];
	private $enable_header = true;
	private $enable_footer = true;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
        $this->meta_arr['meta']['title'] = CI_META_TITLE;
        $this->meta_arr['meta']['description'] = CI_META_DESCRIPTION;
        $this->meta_arr['meta']['keywords'] = CI_META_KEYWORDS;
        $this->meta_arr['meta']['robots'] = CI_META_ROBOTS;
        $this->meta_arr['meta']['viewport'] = CI_META_VIEWPORT;
        
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		log_message('info', 'Controller Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}
	// --------------------------------------------------------------------

	public function request($name) {
		return $this->input->get_post($name);
	}
	// --------------------------------------------------------------------

	public function set_meta_title($name) {
		$this->meta_arr['meta']['title'] .= " | $name";
	}
	// --------------------------------------------------------------------

	public function set_meta_description($description) {
		$this->meta_arr['meta']['description'] = $description;
	}
	// --------------------------------------------------------------------

	public function set_meta_keywords($keywords) {
		$this->meta_arr['meta']['keywords'] .= ", $keywords";
	}
	// --------------------------------------------------------------------

	public function set_meta_data($name, $content) {
		$this->meta_arr['meta'][$name] = $content;
	}
	// --------------------------------------------------------------------

	public function load_view($view, $layout = "system", $data= [], $options = []) {
        $options_arr = array_merge([
            "return_view" => false,
        ], $options);
        
        if($this->enable_header){
            $this->load->view("layout/{$layout}/header", $this->meta_arr);
        }
		
        $this->load->view($view, $data);
        
        if($this->enable_footer){
            $this->load->view("layout/{$layout}/footer");
        }
        
	}
	// --------------------------------------------------------------------

	public function request_obj($tabel = false, $key = false) {
        $obj = lib_db::load_db_default($tabel);
        foreach ($obj->get_fields_arr() as $field => $field_data_arr) {
            $value = $this->request($field);
            $obj->obj->{$field} = $value ? $value : $obj->get_field_default($field);
        }
        
        if(!$key){
            unset($obj->obj->{$obj->get_key()});
        }
        return $obj;
	}
	// --------------------------------------------------------------------

	public function request_db($tabel = false) {
        $obj = lib_db::load_db_default($tabel);
        $id = $this->request($obj->get_key());
        $obj->get_fromdb($id);
        return $obj;
	}
    // --------------------------------------------------------------------
}
