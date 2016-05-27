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
            <div class="showback">
                <table class="table table-striped table-advance table-hover">
                    <h4><i class="fa fa-angle-right"></i> Carte(s) en votre possession : <b><?=sizeof($cards)?></b></h4>
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
                    
                    <form class="form-horizontal style-form" method="post" action="addCardToUser.php">
                        <div class="form-group ">
                            <label class="col-sm-2 control-label">Quelle carte souhaitez-vous ajouter à votre collection ?</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="cardType">
                                    <?php foreach( $cardTypes as $cardType ) : ?>
                                        <option value="<?=$cardType->id?>"><?=$cardType->label?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type"submit" class="btn btn-theme04"><i class="fa fa-plus"></i> Ajouter la carte</button>
                            </div>
                        </div>
                    </form>
                    
                    <br>
                    <br>
                    <br>

                    <?php if( empty($cards) ) : ?>
                        <thead>
                            <tr>
                                <td><i class="fa fa-warning"></i> Vous n'avez aucune carte pour le moment.</td>
                            <tr>
                        </thead>
                    <?php else : ?>
                        <thead>
                            <tr>
                                <th>ID de la carte</th>
                                <th>Type de carte</th>
                                <th>Couleur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach( $cards as $card ) : ?>
                            <tr>
                                <td><?= $card->id ?></td>
                                <td><?= $card->label ?></td>
                                <td>
                                    <span class="label label-<?=$card->color?>"><i class="fa fa-circle"></i></span>
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