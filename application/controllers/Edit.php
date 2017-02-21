<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controle de edição de mangas no banco de dados
 */
class Edit extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Edit_Model','edit');		
		$this->load->model('Index_Model','indexM');
		$this->load->helper('url');
		$this->load->helper('form');		
		$this->load->library('form_validation');
		$this->load->database();
	}


	/**
	 * Carrega a view edit passando todos os mangas do banco de dados
	 *  
	 */
	public function index()
	{
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		//Validação dos campos
		$this->form_validation->set_rules('id', 'id', 'required');

		//Pega todos os mangas
		$mangas = $this->indexM->getAllMangas();

		
		$mangasid= array();

		//Cria uma string com os ID e nome do manga
		foreach($mangas as $manga){
			$mangasid[$manga->ID] = $manga->ID. " - " . $manga->NOME;
		}

		$data['mangas'] = $mangasid;

		//Se a validação estiver incorreta, dar load na view novamente. 
		//Caso estiver correta chamar o model para update no banco de dados
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('edit',$data);
		} else {
			
			$data2 = array(
			'id' => $this->input->post('id'),
			'nome' => $this->input->post('nome'),
			'ultimo' => $this->input->post('ultimo'),
			'pagina' => $this->input->post('pag'),
			'dia' => $this->input->post('dia'),			
			'key' => $this->input->post('key'),			
			'img' => $this->input->post('img')
			);

			//Passando os dados de edição para o Model
			$this->edit->form_edit($data2);
			$data['message'] = 'Data Inserted Successfully';
			

			$data['mangas'] = $this->indexM->getAllMangas();			
			//Carrega o index
			$this->load->view('index',$data);
		}			
	}

	
}
