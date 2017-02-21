<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Pagina em construção!
 * 
 * View do index/home para hosts que permitam acesso a porta 80(utilziar curl)
 * 
 * Informações do capitulo em cor:
 * vermelha representa que o manga está em andamento e ultimo capitulo não foi lido.
 * azul representa que o manga não terá mais lançamentos por estar completo.
 */

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>MList</title>
        <!-- Bootstrap -->
        <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
        
        <!-- Index Styles -->
        <link href="<?php echo base_url('assets/css/index_styles.css') ?> " rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 

        
        <link href="https://fonts.googleapis.com/css?family=Amatic+SC:700" rel="stylesheet">      
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <script type="text/javascript">    


			function O(obj)
			{
    			if (typeof obj == 'object') return obj
    			else return document.getElementById(obj)
			}

			function S(obj)
			{
			 return O(obj).style
			}

			function image(obj,img)
			{
			 S(obj).backgroundImage = 'url('+img+')'
			}

			mBoxArr = [];
			arrCount = 0;

			function fadeInCallback()
			{			  
			        $(mBoxArr[arrCount++]).fadeIn(200,fadeInCallback);   
			}

            function addAnimClasses()
            {
                $('#mainNav').addClass("sticky");
                $('#right').addClass("top-image-right");
                $('#left').addClass("top-image-left");  
                $('#mid').addClass("top-image-mid");
                $('#top-image').addClass("top-image-main");
            }

            function removeAnimClasses()
            {
                  $('#mainNav').removeClass("sticky");
                    $('#mainNav').removeClass("sticky");
                    $('#right').removeClass("top-image-right");
                    $('#left').removeClass("top-image-left");  
                    $('#mid').removeClass("top-image-mid");
                    $('#top-image').removeClass("top-image-main");
            }
			     

			$(document).ready(function(){
			$(mBoxArr[arrCount++]).fadeIn(200,fadeInCallback);
			});


            $(window).scroll(function() {
                if ($(this).scrollTop() > 1 && !($('header').is(':hover'))){  
                    addAnimClasses();
                  }
                  else{
                    removeAnimClasses();
                  }
              });

            $(function() {
                $('header').on('mouseover', function(event) {        
                      removeAnimClasses();
                }).on('mouseout', function(event) {
                if ($(window).scrollTop()>1){               
                        addAnimClasses();
                    }
                });
            })

        </script>
    </head>
    <body> 
  <h1 class="banner">MangaList</h1>
       <header>                          
            <nav class="navbar">
                <div class="container">
                    <ul class="nav navbar-nav menu-manga">
                        <li> <a href="<?= site_url('Insert') ?>"> Insert •</a> </li>
                        <li> <a href="<?= site_url('Edit') ?>" style="padding-left: 0;"> Edit •</a> </li>
                        <li> <a href="<?= site_url('Remove') ?>" style="padding-left: 0;"> Remove</a> </li>
                    </ul>
                </div>
            </nav>
            <hr style="width 300px: 3;  width: 600px; border-top:3px solid #eee">
        </header>
        <div class="container" id="main">            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 all-mangas">
                    <?php $x=0; ?>
                    <?php foreach($mangas as $manga): ?>
                        <div  id=<?= "'".str_replace(' ', '_',$manga->NOME."Box")."'"; ?> class="col-lg-3 col-md-3 col-sm-4 col-xs-5 manga-block"  >
                            <img class="img-circle img-responsive img-center" src="<?= $manga->IMG ?>" alt="" onclick="window.open(<?= "'$manga->URL'" ?> , '_blank')";> 
                             <h1><?= $manga->NOME ?></h1>  
                             <?php $news = $latestChapters[$x] > $manga->ULTIMOCAP && $latestChapters[$x]  != 2000?"style='color:red;'":" ";?>
                             <?php $completed = $latestChapters[$x++] == 2000 ?"style='color:blue;'":" ";?>
                            <?php echo  "<span $news $completed class=\"chapterNumber\" >Cap: $manga->ULTIMOCAP</span>"; ?>
                            <div class="inf-block">
                                <?php echo "<span class=\"pageNumber\" >Página: $manga->PAGINA</span>"; ?>
                                <?php echo "<span class=\"pageNumber\" >D: $manga->DIA</span>"; ?>
                            </div>
                        </div> 
                    <?php endforeach;?>
                </div>              
            </div>
        </div>  
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>       
    </body>
</html>

<?php
//$this->load->view(header);
?>