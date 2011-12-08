<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		Kepler Gelotte
 * @copyright	Copyright (c) 2007, Neighbor Webmaster, Inc.
 * @license		http://www.codeignitor.com/user_guide/license.html
 * @link		http://www.codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Smarty Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Smarty
 * @author		Kepler Gelotte
 * @link		http://www.codeigniter.com/user_guide/libraries/parser.html
 */
require_once BASEPATH . '/third_party/smarty/libs/Smarty.class.php';

class CI_Smarty extends Smarty {

	function CI_Smarty()
	{
		parent::__construct();

		$this->setTemplateDir(APPPATH . "views")
			->setConfigDir(APPPATH . 'smarty/config')
			->setCacheDir(APPPATH . "var/smarty_cache")
			->setCompileDir(APPPATH . "var/smarty_templates_c")
			->addPluginsDir(array(
					BASEPATH . "/third_party/smarty_plugins",
					APPPATH . "third_party/smarty_plugins",
					));
		$this->debugging = get_instance()->config->item('smarty_debug');
		$this->error_reporting = E_ALL & ~E_NOTICE;
		$this->assign( 'APPPATH', APPPATH );
		$this->assign( 'BASEPATH', BASEPATH );

		log_message('debug', "Smarty Class Initialized");
	}


	/**
	 *  Parse a template using the Smarty engine
	 *
	 * This is a convenience method that combines assign() and
	 * display() into one step.
	 *
	 * Values to assign are passed in an associative array of
	 * name => value pairs.
	 *
	 * If the output is to be returned as a string to the caller
	 * instead of being output, pass true as the third parameter.
	 *
	 * @access	public
	 * @param	string
	 * @param	array
	 * @param	bool
	 * @return	string
	 */
	function view($template, $data = array(), $return = FALSE)
	{
		foreach ($data as $key => $val)
		{
			$this->assign($key, $val);
		}

		if ($return == FALSE)
		{
			if ($this->debugging) {
				$this->display($template);
			}
			else {
				$CI =& get_instance();
				$CI->output->append_output($this->fetch($template));
				return;
			}
		}
		else
		{
			return $this->fetch($template);
		}
	}
}
// END Smarty Class
