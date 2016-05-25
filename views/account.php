<!-- **********************************************************************************************************************************************************
HEADER
*********************************************************************************************************************************************************** -->
<?php include_once('include/header.php'); ?>

<!-- **********************************************************************************************************************************************************
TOP BAR
*********************************************************************************************************************************************************** -->
<?php include_once('include/topbar.php'); ?>

<!-- **********************************************************************************************************************************************************
SIDEBAR LEFT
*********************************************************************************************************************************************************** -->
<?php include_once('include/navbar-left.php'); ?>

<!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i> <?= $page_title ?></h3>

    <div class="row mt">
      <div class="col-sm-12">
        <div class="showback">
          <h4><i class="fa fa-angle-right"></i> Informations générales</h4>
          <form class="form-horizontal style-form" method="">
            <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">Nom</label>
                <div class="col-lg-10">
                    <p class="form-control-static"><?= $user->lastname ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">Prénom</label>
                <div class="col-lg-10">
                    <p class="form-control-static"><?= $user->firstname ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">Email</label>
                <div class="col-lg-10">
                    <p class="form-control-static"><?= $user->email ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">Date d'inscription</label>
                <div class="col-lg-10">
                    <p class="form-control-static"><?= date("d\/m\/Y \à G:i:s", $user->registered_at );?></p>
                </div>
            </div>
          </form>
        </div><!-- showback -->
      </div><!-- col-sm-12 -->  
    </div><!-- row mt -->

    <div class="row mt">
      <div class="col-md-12">
        <div class="content-panel">
            <table class="table table-striped table-advance table-hover">
              <h4><i class="fa fa-angle-right"></i> Carte(s) en votre possession</h4>
              <hr>
              <?php if( empty($cards) ) : ?>
                <thead>
                  <tr>
                    <td><i class="fa fa-warning"></i> Vous n'avez aucune carte pour le moment.</td>
                  <tr>
                </thead>
              <?php endif; ?>
              <!--<thead>
                <tr>
                    <th><i class="fa fa-bullhorn"></i> Company</th>
                    <th class="hidden-phone"><i class="fa fa-question-circle"></i> Descrition</th>
                    <th><i class="fa fa-bookmark"></i> Profit</th>
                    <th><i class=" fa fa-edit"></i> Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><a href="basic_table.html#">Company Ltd</a></td>
                    <td class="hidden-phone">Lorem Ipsum dolor</td>
                    <td>12000.00$ </td>
                    <td><span class="label label-info label-mini">Due</span></td>
                    <td>
                        <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="basic_table.html#">
                            Dashgum co
                        </a>
                    </td>
                    <td class="hidden-phone">Lorem Ipsum dolor</td>
                    <td>17900.00$ </td>
                    <td><span class="label label-warning label-mini">Due</span></td>
                    <td>
                        <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="basic_table.html#">
                            Another Co
                        </a>
                    </td>
                    <td class="hidden-phone">Lorem Ipsum dolor</td>
                    <td>14400.00$ </td>
                    <td><span class="label label-success label-mini">Paid</span></td>
                    <td>
                        <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="basic_table.html#">
                            Dashgum ext
                        </a>
                    </td>
                    <td class="hidden-phone">Lorem Ipsum dolor</td>
                    <td>22000.50$ </td>
                    <td><span class="label label-success label-mini">Paid</span></td>
                    <td>
                        <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                    </td>
                </tr>
                <tr>
                    <td><a href="basic_table.html#">Total Ltd</a></td>
                    <td class="hidden-phone">Lorem Ipsum dolor</td>
                    <td>12120.00$ </td>
                    <td><span class="label label-warning label-mini">Due</span></td>
                    <td>
                        <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                    </td>
                </tr>
                </tbody>-->
            </table>
        </div><!-- /content-panel -->
    </div><!-- /col-md-12 -->
    </div><!-- row mt -->
  </section> 
</section>

<!-- **********************************************************************************************************************************************************
FOOTER
*********************************************************************************************************************************************************** -->
<?php include_once('include/footer.php'); ?>