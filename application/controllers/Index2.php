<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controle do index2(Alternativa de index para hosts que não bloqueiam curl)
 */
class Index2 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Index_Model','indexM');			
		$this->load->model('News_Model','newsM');	
	}

	/**
	 * Carrega o index
	 */
	public function index()
	{				

		$data['mangas'] = $this->indexM->getAllMangas();		

		$data['latestChapters'] = $this->newsM->latestChapters($data['mangas']);
		//$this->indexM->verifyCovers($data['mangas']);
		$this->load->view('index2',$data);
	}
}
