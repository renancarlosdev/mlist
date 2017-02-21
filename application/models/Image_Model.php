<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model responsável pela pesquisa de imagem/url da imagem
 */
class Image_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/** 
	 *  Pega todos os mangas do banco e verifica se é possível encontrar a url da imagem usada na pagina
	 *  principal do manga no site de manga online
	 *  
	 *  Atualmente funcionando para o Mangafox, Mangahere e Mangamap
	 *
	 * @param      array[]  $mangas  Todos os mangas
	 */
	public function searchUrl($mangas)
	{
		//Para cada manga, pegar o link da imagem.
		
		foreach($mangas as $manga){

			//Pega a base do link do manga que direciona para a pagina principal do manga
			preg_match("#http://[^/]*/(manga/)?[^/]*/#",$manga->URL,$match);
			
			//Se for possível encontrar o link desejado
			if(count($match) > 0 ){

				//Ir até o link e explodir o código de html, nas quebras de linhas(\n), em uma array

				$refinedURL = $match[0];
				$c = curl_init($refinedURL);
				curl_setopt($c, CURLOPT_RETURNTRANSFER, true);	
				$html = curl_exec($c);
				$lines = explode("\n",$html);

				//Instancia as variaveis necessárias para a operação
				$CodeNeeded = false; 
				$EndOfDiv = false;
				$urlImage = '';
				$found = false;
				$x=0;
				$lineWanted='';
			
				//Executar a operação enquanto existir linhas e o link da imagem não for encontrado
				while($x++ < count($lines)-1 && !$found)
				{
					//Linha atual
					$line= $lines[$x];

					//Se a linha conter mng_ifo, manga_detail ou series_info a url da imagem está perto
					if (strpos($line,'mng_ifo') !== false || strpos($line,'series_info') !== false || strpos($line,'manga_detail') !== false){
						$CodeNeeded = true; 
					}

					//Se a linha conter src="http:// a url da imagem está nessa linha
					if($CodeNeeded && strpos($line,'src="http://') !== false)
					{
						$lineWanted = $line;						
						$CodeNeeded = false;
						$EndOfDiv = true;
					}

					//Pega a url da imagem
					
					if($EndOfDiv && $lineWanted !== '')
					{ 
						//Achar o que começa com http,tem tudo no meio menos aspas e parar quando achar aspas
						$matches;
						$pattern = "#http://[^\"]*\"#";
						preg_match($pattern,$lineWanted,$matches);
						

						if($matches[0]!=='')
							$urlImage = str_replace("\"", " ",$matches[0]);

													
						$found = true;
						
						$lineWanted = "";
					}	
				}

			echo $urlImage."!!<br><br> ";	
					
			$data2 = array(
			'id' => $manga->ID,
			'url' => $urlImage			
			);

			//Envia a informação para o Model
			$this->edit->form_edit_IMG($data2);
			}
		}
	}
}