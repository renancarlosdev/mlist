<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Pagina em construção!
 * 
 * View do index/home para hosts que não permitam acesso a porta 80(utilziar curl)
 * 
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

        <header>
                <div id="top-image" class="top-image">
                      <div id="left" class="left"></div>
                      <div id="mid" class="mid"></div>              
                      <div id="right" class="right"></div>
                </div>            
                <nav id="mainNav" class="navbar">
                    <div class="container">
                        <ul class="nav navbar-nav">
                            <li> <a href="<?= site_url('Insert') ?>"> Insert</a> </li>
                            <li> <a href="<?= site_url('Edit') ?>"> Edit</a> </li>
                            <li> <a href="<?= site_url('Remove') ?>"> Remove</a> </li>
                        </ul>
                    </div>
                </nav>
        </header>
        <div class="container-fluid" id="main">            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php foreach($mangas as $manga): ?>
                        <div  id=<?= "'".str_replace(' ', '_',$manga->NOME."Box")."'"; ?> class="col-lg-2 col-md-3 col-sm-4 col-xs-5" style="display:none;" >
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mBox" onclick="window.open(<?= "'$manga->URL'" ?> , '_blank');">
                                <div id=<?= "'$manga->NOME'" ?> class="bck"></div>
                                <div id=<?= "'id_$manga->ID'" ?>></div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 abs ">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mBoxHead ">                               
                                        <?php echo  "<p class=\"chapterNumber\" >$manga->ULTIMOCAP</p>"; ?>
                                        <?php echo "<p class=\"pageNumber\" >P $manga->PAGINA</p>"; ?>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mBoxName">
                                        <?php echo "<p class='mangaName'>$manga->NOME</p>"; ?>
                                    </div>
                                </div> 
                            </div> 
                        </div>
                        <script type="text/javascript"> image(<?= "'$manga->NOME'".","."'".trim($manga->IMG)."'" ?>); mBoxArr.push(<?= "'".str_replace(' ', '_',"#".$manga->NOME."Box")."'"; ?>); </script>
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