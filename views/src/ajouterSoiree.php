<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title><?= $page_title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="view/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="view/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="view/assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="view/assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="view/assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="view/assets/css/style.css" rel="stylesheet">
    <link href="view/assets/css/style-responsive.css" rel="stylesheet">

    <script src="view/assets/js/chart-master/Chart.js"></script>
    
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b>BDE GESTION SOIREES</b></a>
            <!--logo end-->
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="deconnexion.php">Déconnexion</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      SIDEBAR LEFT
      *********************************************************************************************************************************************************** -->
      <?php include_once('include/navbar-right.php'); ?>
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
            <h3><i class="fa fa-angle-right"></i> <?= $page_title ?></h3>
            <div class="row mt">
              <div class="col-md-12">
                <div class="content-panel">
                 <form class="form-login" action="validationAjoutSoiree.php" method="post">
		        <h2 class="form-login-heading">Ajouter une Soirée</h2>
		        <div class="login-wrap">
                    <?php if(isset($_GET['err'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        Erreur dans le formulaire :<br>
                        <?php 
                        switch($_GET['err']) :
                            case 1 :
                                echo '- Nom de Soirée invalide';
                                break; 
                            case 2 :
                                echo '- Date debut vote invalide';
                                break;
                            case 3 :
                                echo '- Date fin vote invalide';
                                break;
							case 4 :
								echo '- Date de la Soirée invalide';
								break;
                        endswitch; ?>
                    </div>
                    <?php endif;?>
                    <input type="text" class="form-control" placeholder="Nom de la Soiree" name="NomSoiree" autofocus>
		            <br>
		            <input type="date" class="form-control" placeholder="Date Ouverture Vote" name="DateOuvertureVote">
		            <br>
                    <input type="date" class="form-control" placeholder="Date Fermeture Vote" name="DateFermetureVote">
		            <br>
                    <input type="date" class="form-control" placeholder="Date Soirée" name="DateSoiree">
		            <br>
		            <label class="checkbox"> <span class="pull-right"> </span>
		            </label>
		            <button class="btn btn-theme btn-block" href="validationAjoutSoiree.php" type="submit"><i class="fa fa-plus"></i> Ajouter configuration</button>
		      </form>	 
                </div><! --/content-panel -->
              </div><!-- /col-md-12 -->
            </div>
          </section>
      </section> 
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="view/assets/js/jquery.js"></script>
    <script src="view/assets/js/jquery-1.8.3.min.js"></script>
    <script src="view/assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="view/assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="view/assets/js/jquery.scrollTo.min.js"></script>
    <script src="view/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="view/assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="view/assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="view/assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="view/assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="view/assets/js/sparkline-chart.js"></script>    
	<script src="view/assets/js/zabuto_calendar.js"></script>	
	
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  

  </body>
</html>
