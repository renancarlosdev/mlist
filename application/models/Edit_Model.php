<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  Model responsável pela edição dos mangas
 */
class Edit_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 *  Update de todas informações do manga
	 *
	 * @param      array[]  $data   Informações de update
	 */
	public function form_edit($data)
	{
		// Editando a tabela
		$this->db->set('NOME',"'".$data['nome']."'", FALSE);
		$this->db->where('ID',(int)$data['id']);
		$this->db->update('manga');
	}

	/**
	 * Update das url de imagem dos mangas
	 *
	 * @param      array[]  $data   Informações de update
	 */
	public function form_edit_IMG($data)
	{
		// Editando a tabela	
		$this->db->set('IMG',"'".$data['url']."'", FALSE);
		$this->db->where('ID',(int)$data['id']);
		$this->db->update('manga'); 
		echo "edited";
	}
}