
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
        </div><! -- /darkblue panel -->
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
        </div><! -- /darkblue panel -->
      </div><!-- /col-md-4 -->
    </div>
  </section> 
</section>