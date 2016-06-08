
<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i> <?= $page_title ?></h3>

    <div class="row">
      <div class="col-md-4 col-sm-4 mb">
        <div class="darkblue-panel pn">
          <div class="darkblue-header">
            <h5>MEMBRES CONNECTES</h5>
          </div>

          <h1 class="mt"><i class="fa fa-user fa-3x"></i></h1>
          <footer>
            <div class="centered">
              <h5><?= $nbConnected ?></h5>
            </div>
          </footer>
        </div><!-- /darkblue panel -->
      </div><!-- /col-md-4 -->

      <div class="col-md-4 col-sm-4 mb">
        <div class="darkblue-panel pn">
          <div class="darkblue-header">
            <h5>CARTES EN JEU</h5>
          </div>

          <h1 class="mt"><i class="fa fa-file fa-3x"></i></h1>
          <footer>
            <div class="centered">
              <h5><?= $nbCards ?></h5>
            </div>
          </footer>
        </div><!-- /darkblue panel -->
      </div><!-- /col-md-4 -->

      <div class="col-md-4 col-sm-4 mb">
        <div class="darkblue-panel pn">
          <div class="darkblue-header">
            <h5>CARTE LA PLUS ECHANGEE</h5>
          </div>

          <h1 class="mt"><i class="fa fa-file fa-3x"></i></h1>
          <footer>
            <div class="centered">
              <?php if (!empty($mostTradedCard)) : ?>
                <h5><?= $mostTradedCard->label; ?></h5>
                <h6>Echangée <?= $mostTradedCard->nbTrades; ?> fois</h6>
              <?php else : ?>
                <h5>Aucune carte n'a encore été échangée</h5>
              <?php endif; ?>
            </div>
          </footer>
        </div><!-- /darkblue panel -->
      </div><!-- /col-md-4 -->

    </div> <!-- /row -->

    <div class="row">
      <div class="col-md-4 col-sm-4 mb">
        <div class="darkblue-panel pn">
          <div class="darkblue-header">
            <h5>MEILLEUR DONNEUR</h5>
          </div>

          <h1 class="mt"><i class="fa fa-user fa-3x"></i></h1>
          <footer>
            <div class="centered">
              <?php if(!empty($bestGiver)) :?>
                <h5><?= $bestGiver->lastname." ".$bestGiver->firstname; ?></h5>
                <h6><?= $bestGiver->nbCardGiven; ?> cartes données</h6>
              <?php else : ?>
                <h5>Aucun utilisateur n'a encore effectué d'échanges</h5>
              <?php endif; ?>
            </div>
          </footer>
        </div><!-- /darkblue panel -->
      </div><!-- /col-md-4 -->

      <div class="col-md-4 col-sm-4 mb">
        <div class="darkblue-panel pn">
          <div class="darkblue-header">
            <h5>MEILLEUR CHERCHEUR</h5>
          </div>

          <h1 class="mt"><i class="fa fa-user fa-3x"></i></h1>
          <footer>
            <div class="centered">
              <?php if(!empty($bestSeeker)) :?>
                <h5><?= $bestSeeker->lastname." ".$bestSeeker->firstname; ?></h5>
                <h6><?= $bestSeeker->nbCardGiven; ?> cartes récupérées</h6>
              <?php else : ?>
                <h5>Aucun utilisateur n'a encore effectué d'échanges</h5>
              <?php endif; ?>
            </div>
          </footer>
        </div><!-- /darkblue panel -->
      </div><!-- /col-md-4 -->

      <div class="col-md-4 col-sm-4 mb">
        <div class="darkblue-panel pn">
          <div class="darkblue-header">
            <h5>NOMBRE DE CARTES DU PLUS GRAND ECHANGE</h5>
          </div>

          <h1 class="mt"><i class="fa fa-file fa-3x"></i></h1>
          <footer>
            <div class="centered">
              <h5><?= $nbCardsBiggestTrade ?></h5>
            </div>
          </footer>
        </div><!-- /darkblue panel -->
      </div><!-- /col-md-4 -->

    </div> <!-- /row -->
  </section> 
</section>