<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i> <?= $page_title ?></h3>

    <div class="row mt">
        <div class="col-md-12">
            <div class="showback">
                <table class="table table-striped table-advance table-hover">
                    <h4><i class="fa fa-angle-right"></i> Echange(s) simplement débuté(s) : <b><?=sizeof($trades)?></b></h4>

                    <?php if( empty($trades) ) : ?>
                        <thead>
                            <tr>
                                <td><i class="fa fa-warning"></i> Vous n'avez encore proposé aucune carte à l'échange.</td>
                            <tr>
                        </thead>
                    <?php else : ?>
                        <thead>
                            <tr>
                                <th>ID de l'échange</th>
                                <th>Date de début</th>
                                <th>Nombre de cartes proposées</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach( $trades as $trade ) : ?>
                            <tr>
                                <td class="mytrades-show-id"><?= $trade['id'] ?></td>
                                <td>
                                  <?= date('d/m/Y à H:i:s', $trade['dateBegin'] ) ?>
                                </td>
                                <td><?= sizeof($trade['cards']) ?></td>
                                <td> 
                                    <button class="btn btn-primary btn-xs btn-mytrades-show" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye"></i></button> 
                                    <button class="btn btn-danger btn-xs btn-mytrades-delete"><i class="fa fa-ban"></i></button> 
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    <?php endif; ?>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div><!-- row mt -->
  </section> 
</section>

<div class="showback">
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Composition de l'échange <span id="mytrades-show-id">#3</span> </h4>
          </div>
          <div class="modal-body">
            <table class="table table-striped mytrades-show">
                <tr>
                    <th>ID de la carte</th>
                    <th>Libellé</th>
                    <th>Couleur</th>
                </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
          </div>
        </div>
      </div>
    </div>                      
</div><!-- /showback -->
