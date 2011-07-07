<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Sitemap extends Module {

	public $version = '1.0';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Sitemap'
			),
			'description' => array(
				'en' => 'Create a dynamic sitemap.'
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu' => FALSE
		);
	}

	public function install()
	{
	/*
		// Create polls table
		$this->db->query("
			CREATE TABLE IF NOT EXISTS `polls` (
			`id` tinyint(11) unsigned NOT NULL AUTO_INCREMENT,
			`slug` varchar(64) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT
		");
	*/

		// It worked!
		return TRUE;
	}

	public function uninstall()
	{
	/*
		// Get 
		$this->db->query("DROP TABLE `polls`");
	*/
		return TRUE;
	}

	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}

	public function help()
	{
		// You could include a file and return it here.
		return "Some Help Stuff";
	}
}
