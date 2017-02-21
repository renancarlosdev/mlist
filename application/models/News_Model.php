<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model responsável pela pesquisa dos ultimos capitulos lançados
 */
class News_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/** 
	 *  Pega todos os mangas do banco e verifica se é possível encontrar o ultimo capitulo do manga
	 *  na pagina principal do manga no site de manga online. Se o manga estiver completo retorna "2000"
	 *  
	 *  Atualmente funcionando para o Mangafox, Mangahere e Mangamap
	 *
	 * @param      array[]  $mangas  Todos os mangas
	 */
	public function latestChapters($mangas)
	{

		$latestChapters = array();

		//Para cada manga, pegar o link do ultimo cap e verificar o lançamento
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
			
				//Executar a operação enquanto existir linhas e o lançamento não for encontrado
				while($x < count($lines)-1 && !$found)
				{
					//linha atual
					$line= $lines[$x];

					//Se a linha conter ongoing ou Ongoing o ultimo capitulo lançado está próximo
					if (strpos($line,'Ongoing') !== false || strpos($line,'ongoing') !== false){
						$CodeNeeded = true; 
					}

					//Se a linha conter Completed ou completed o manga acabou, settar latestChapters para 2000(equivale a "manga completo")
					if (strpos($line,'Completed') !== false || strpos($line,'completed') !== false){
						 $found = true;								
						 $lineWanted = "";
						 $latestChapters[] = 2000;
					}

					//Se a linha conter ongoing ou .next o ultimo capitulo lançado está próximo
					//!== de false pois strpos retorna a posição da palavra e .next !== true pois pode confundir com "element.next()" da pagina
					if($CodeNeeded && strpos($line,'next') !== false && strpos($line,'.next') !== true)
					{
						$lineWanted = $line;						
						$CodeNeeded = false;
						$EndOfDiv = true;
					}

					//Pega o ultimo capitulo lançado
					
					if($EndOfDiv && $lineWanted !== '')
					{ 
						
						$words = explode("\\s|</",$lineWanted);


						foreach($words as $word){	
							
							//Achar a palavra que conten apenas, pelo menos um, digito
							$matches;
							$pattern = "#\\b\\d+\\b#";
							preg_match($pattern,$lineWanted,$matches);
							
							//Se a palavra conter apenas digito é o número do ultimo capitulo lançado
							if($matches[0]!=='')
							{
								$lastCapReleased = $matches[0];
								$latestChapters[] = $lastCapReleased;

								$found = true;								
								$lineWanted = "";
							}	
						}
					}	
					$x++;
				}
				if(!$found)
					$latestChapters[] = $manga->ULTIMOCAP;
			}
		}
		return $latestChapters;
	}


}