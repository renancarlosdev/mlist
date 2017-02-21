<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controle de news (Novos capitulos lançados em relação aos ultimos lidos)
 */
class News extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Index_Model','indexM');	
		$this->load->model('News_Model','newsM');
	}

	/**
	 *  Pega todos mangas e envia para o model de news
	 */
	public function index()
	{

		$mangas = $this->indexM->getAllMangas();

		$latestChapters = $this->newsM->latestChapters($mangas);
	}
	
}
