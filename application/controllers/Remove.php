<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controle de remoção de manga
 */
class Remove extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Remove_Model','remove');		
		$this->load->model('Index_Model','indexM');
		$this->load->helper('url');
		$this->load->helper('form');		
		$this->load->library('form_validation');
		$this->load->database();
	}

	/**
	 * Carrega a view remove passando todos os mangas do banco de dados
	 */
	public function index()
	{
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		//Validação dos campos
		$this->form_validation->set_rules('id', 'id', 'required');

		$mangas = $this->indexM->getAllMangas();

		$mangasid= array();

		foreach($mangas as $manga){
			$mangasid[$manga->ID] = $manga->ID. " - " . $manga->NOME;
		}

		$data['mangas'] = $mangasid;

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('remove',$data);
		} else {
			
			$data2 = array(
			'id' => $this->input->post('id')
			);
			//Transfere dados para o model
			$this->remove->form_remove($data2);
			$data['message'] = 'Data Inserted Successfully';
			//Carrega a view
			$data['mangas'] = $this->indexM->getAllMangas();
			
			$this->load->view('index',$data);
		}	
	}

	
}
