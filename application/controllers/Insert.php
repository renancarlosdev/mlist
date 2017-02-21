<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controle de inserção de manga no banco de dados
 */
class Insert extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Insert_Model','insert');
		$this->load->model('Index_Model','indexM');
		$this->load->helper('url');
		$this->load->helper('form');		
		$this->load->library('form_validation');
		$this->load->database();
	}

	/**
	 * Carrega a view insert
	 */
	public function index()
	{
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		//Validação dos campos
		$this->form_validation->set_rules('nome', 'Nome', 'required');		
		$this->form_validation->set_rules('key', 'key', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('insert');
		} else {
			
			$data = array(
			'NOME' => $this->input->post('nome'),
			'ULTIMOCAP' => $this->input->post('ultimo'),
			'PAGINA' => $this->input->post('pag'),
			'DIA' => $this->input->post('dia'),			
			'KEYWORD' => $this->input->post('key'),			
			'IMG' => $this->input->post('img')
			);
			
			$data['ULTIMOCAP'] = $data['ULTIMOCAP'] == '' ? 0: $data['ULTIMOCAP'];			
			$data['PAGINA'] = $data['PAGINA'] == '' ? 0: $data['PAGINA'];

			//Transfere dados para o Model
			$this->insert->form_insert($data);
			$data['message'] = 'Data Inserted Successfully';
			//Carrega View
			$data['mangas'] = $this->indexM->getAllMangas();
			
			$this->load->view('index',$data);
		}			
	}

	
}
