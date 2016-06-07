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
                <table class="table table-striped table-advance table-hover table-search-show">
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
                            <th>ID de la carte</th>
                            <th>Type de carte</th>
                            <th>Couleur</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div><!-- row mt -->
  </section> 
</section>