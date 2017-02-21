<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controle do index
 */
class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Index_Model','indexM');		
	}

	/**
	 * Carrega o index
	 */
	public function index()
	{				

		$data['mangas'] = $this->indexM->getAllMangas();
		//$this->indexM->verifyCovers($data['mangas']);
		$this->load->view('index',$data);
	}
}
