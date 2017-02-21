<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model responsável pela remoção de manga do banco de dados
 */
class Remove_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Remove um manga do banco de dados
	 *
	 * @param     array[]  $data   informações necessárias para a remoção
	 */
	public function form_remove($data)
	{		
		$this->db->where('ID',(int)$data['id']);
		$this->db->delete('manga');
	}
}