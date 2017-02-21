<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Classe utilizada como apoio para alterações ocasionais
 */
class altertable extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->dbforge();
	}

	public function index()
	{
		$fields = array(
        'IMG' => array(                
                'type' => 'varchar(150)',
        ),
		);
		$this->dbforge->modify_column('manga', $fields);
		echo "edited";
		
	}	
}
