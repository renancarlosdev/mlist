<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model responsável pela pesquisa de manga para o index/home
 */
class Index_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		//$this->load->helper('url');
	}
	
	/**
	 * Retorna todos os mangas
	 *
	 * @return     array[]  Todos os mangas.
	 */
	public function getAllMangas()
	{
		$query = $this->db->get('manga');
		$data = $query->result();
		$this->db->close();
		return $data;
	}
}