<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i> <?= $page_title ?></h3>

    <div class="row mt">
        <div class="col-md-12">
            <div class="showback">
                <table class="table table-striped table-advance table-hover">
                    <p>
                        Utilisez cette barre de navigation pour trouver si la carte que vous recherchez est partagée par d'autres membres    
                    </p>

                    <?php 
                    if( isset($_GET['err']) ) :
                        switch($_GET['err']) :
                            case '0' : 
                                $message = "<b> Bien joué !</b> Carte ajoutée avec succès."; 
                                break; 
                            case '1' : 
                                $message = "<b> Erreur !</b> Type de carte invalide."; 
                                break; 
                            case '2' : 
                                $message = "<b> Erreur !</b> Reconnectez-vous pour résoudre le problème."; 
                                break; 
                        endswitch; 

                        if( $_GET['err'] > 0 ) :
                            echo '<div class="alert alert-error">'.$message.'</div>';
                        else :
                            echo '<div class="alert alert-success">'.$message.'</div>';
                        endif;
                    endif;
                    ?>
                    
                    <form class="form-horizontal style-form" id='form-search' method="post" action="">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Quelle carte recherchez-vous ?</label>
                            <div class="col-sm-8">
                                <select class="form-control" id='form-search-select' name="cardType">
                                    <?php foreach( $cardTypes as $cardType ) : ?>
                                        <option value="<?=$cardType->id?>"><?=$cardType->label?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type"submit" class="btn btn-theme04"><i class="fa fa-eye"></i> Rechercher la carte</button>
                            </div>
                        </div>
                    </form>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div><!-- row mt -->

    <div class="row mt search-result">
        <div class="col-md-12">
            <div class="showback">
                <table class="table table-striped table-advance table-hover search-show">
                    <h4><i class="fa fa-angle-right"></i> Résultat de la recherche : <b id="search-result-nb">0</b></h4>
                    <?php 
                    if( isset($_GET['err']) ) :
                        switch($_GET['err']) :
                            case '0' : 
                                $message = "<b> Bien joué !</b> Carte ajoutée avec succès."; 
                                break; 
                            case '1' : 
                                $message = "<b> Erreur !</b> Type de carte invalide."; 
                                break; 
                            case '2' : 
                                $message = "<b> Erreur !</b> Reconnectez-vous pour résoudre le problème."; 
                                break; 
                        endswitch; 

                        if( $_GET['err'] > 0 ) :
                            echo '<div class="alert alert-error">'.$message.'</div>';
                        else :
                            echo '<div class="alert alert-success">'.$message.'</div>';
                        endif;
                    endif;
                    ?>

                    <thead>
                        <tr>
                            <th>ID du trade</th>
                            <th>Membre</th>
                            <th>Composition du paquet à échanger</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div><!-- row mt -->

    <div class="row mt search-togive">
      <div class="col-sm-12">
        <div class="showback">
            <h3>Début de l'échange <b class="trade-id"></b></h3>
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
            
            <hr>

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
            <button class="btn btn-block btn-theme04 btn-search-propose-submit"><i class="fa fa-cloud-upload"></i> Envoyer la proposition</button>
        </div><!-- showback -->
      </div><!-- col-sm-12 -->  
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
            <h4 class="modal-title" id="myModalLabel">Composition de l'échange <span id="search-show-id">#3</span> </h4>
          </div>

          <div class="modal-body">
            <table class="table table-striped search-trade-show">
                <thead>
                    <th>ID de la carte</th>
                    <th>Libellé</th>
                    <th>Couleur</th>
                </thead>

                <tbody>
                </tbody>
            </table>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
          </div>
        </div>
      </div>
    </div>                      
</div><!-- /showback -->