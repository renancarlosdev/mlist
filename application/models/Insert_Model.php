<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model responsável pela inserção de manga no banco de dados
 */
class Insert_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 *  Inseri o manga no banco de dados
	 *
	 * @param      array[]  $data   Informações do manga para inserção
	 */
	public function form_insert($data)
	{
		$this->db->insert('manga', $data);
	}
}