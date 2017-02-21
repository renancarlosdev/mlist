<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controle da imagem/url da imagem do manga
 */
class Image extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Index_Model','indexM');	
		$this->load->model('Edit_Model','edit');
		$this->load->model('Image_Model','imageM');	
	}

	/**
	 *  Pega todos os mangas e envia para o model
	 */
	public function index()
	{
		//Pega todos os mangas
		$mangas = $this->indexM->getAllMangas();

		$this->imageM->searchUrl($mangas);				
	}
}
