<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * The sitemap module enables users to view html and xml sitemaps for the content on their site.
 *
 * @author 		Tim Greenwood
 * @package 	PyroCMS
 * @subpackage 	Sitemap Module
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class Sitemap extends Public_Controller
{
	/**
	 * Constructor method
	 *
	 * @author Tim Greenwood
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
		// Give erro in pyrocms 2.1.5 and 2.2.0
		$this->data = new stdClass;
		
		// Load the required classes
		$this->load->model('Sitemap_m');
		$this->load->helper('html');
	}
	
	/**
	 * Index method
	 *
	 * @access public
	 * @return void
	 */
	public function index()
	{
		$data->links = $this->Sitemap_m->getLinks();

		$this->template
			->title($this->module_details['name'])
			->build('index', $data);
	}
	
	/**
	 * XML method
	 *
	 * @access public
	 * @return void
	 */
	public function xml()
	{
		$data->links = $this->Sitemap_m->getLinks();

		$this->template
			->title($this->module_details['name'])
			->build('xml', $data);
	}
}
