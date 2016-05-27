<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i> <?= $page_title ?></h3>

    <div class="row mt">
      <div class="col-sm-12">
        <div class="showback">
            <h4><i class="fa fa-angle-right"></i> A votre disposition : <b class="table-yourcollection-count"><?=sizeof($cards)?></b></h4>
            <table class="table table-striped table-advance table-hover table-yourcollection">
                <?php if( empty($cards) ) : ?>
                    <thead>
                        <tr>
                            <td><i class="fa fa-warning"></i> Vous n'avez aucune carte pour le moment.</td>
                        <tr>
                    </thead>
                <?php else : ?>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Type de carte</th>
                            <th>Couleur</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach( $cards as $card ) : ?>
                        <tr class="table-yourcollection">
                            <td class="table-yourcollection-id" value="<?= $card->id ?>"><?= $card->id ?></td>
                            <td class="table-yourcollection-label"><?= $card->label ?></td>
                            <td> <span class="label label-<?=$card->color?>"><i class="fa fa-circle"></i></span> </td>
                            <td> <button class="btn btn-success btn-xs btn-propose" data="plus"><i class="fa fa-plus"></i></button> </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                <?php endif; ?>
            </table>
        </div><!-- showback -->
      </div><!-- col-sm-12 -->  
    </div><!-- row mt -->

    <div class="row mt">
      <div class="col-sm-12">
        <div class="showback">
            <h4><i class="fa fa-angle-right"></i> Votre proposition : <b class="table-yourproposition-count">0</b></h4>
            <table class="table table-striped table-advance table-hover table-yourproposition">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type de carte</th>
                        <th>Couleur</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <br>
            <button class="btn btn-block btn-theme04 btn-propose-submit"><i class="fa fa-cloud-upload"></i> Mettre en ligne la proposition</button>
        </div><!-- showback -->
      </div><!-- col-sm-12 -->  
    </div><!-- row mt -->
  </section> 
</section>