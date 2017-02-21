<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Classe de apoio para teste de host sobre o CURL
 */
class TestCURL extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Abre a pagina do g1 e pega o html escrevendo em uma arquivo teste
	 */
	public function index()
	{
		$ch = curl_init("http://g1.globo.com/");
		$fp = fopen("example_homepage.txt", "w");

		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HEADER, 0);

		curl_exec($ch);
		curl_close($ch);
		fclose($fp);
	}	
}
