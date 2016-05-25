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
      <?php $date = new DateTime($data['DateSoiree']); ?>
      <section id="main-content">
          <section class="wrapper site-min-height">
            <h3><i class="fa fa-angle-right"></i> <?= $page_title ?></h3>
            <div class="row mt">
              <div class="col-md-12">
                <div class="form-panel">
                    <h4><i class="fa fa-angle-right"></i> Informations</h4>
                    <hr>
                    <form class="form-horizontal style-form" method="get">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Nom de la soirée</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="disabledInput" type="text" placeholder="<?=$data['NomSoiree']?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Date de la soirée</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="disabledInput" type="text" placeholder="<?=$date->format('d/m/Y').' à '.$date->format('H:i:s') ?>" disabled>
                            </div>
                        </div>
                    </form>
                </div><! --/content-panel -->
                <?php if(!$votesClos && !aVoteSoiree(getUserID(), $_GET['idSoiree']) ) : ?>
                  <div class="form-panel">
                      <h4><i class="fa fa-angle-right"></i> Votez pour votre configuration préférée</h4>
                      <hr>
                      <form class="form-horizontal style-form" method="post" action="valideVote.php">
                        <input type="hidden" value="<?=$_GET['idSoiree']?>">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Configurations :</label>
                            <div class="col-sm-10">
                                <?php $i = 0; ?>  
                                <?php foreach($configs as $config) : ?>
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="choixVote"  value="<?=$config['IdConfig']?>">
                                    <?php $str = ""; ?>
                                    <?php foreach ($etapes[$i] as $etape) :
                                      if( $etape['IdConfig'] == $config['IdConfig'] ) {
                                        $str .= $etape['etapeType'].": " .$etape['name']." - ";
                                      }
                                    endforeach; ?>
                                    <?= $str ?>
                                  </label>
                                </div>
                                <?php $i++ ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <button class="btn btn-theme btn-block" href="valideVote.php" type="submit"><i class="fa fa-plus"></i> Voter</button>
                    </form>
                  </div><! --/content-panel -->
                <?php else: ?>
                  <div class="form-panel">
                      <h4><i class="fa fa-angle-right"></i> Les votes sont clos ou vous avez déjà voté pour cette soirée</h4>
                  </div>
                <?php endif; ?>
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
