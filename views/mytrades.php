<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i> <?= $page_title ?></h3>

    <div class="row mt">
        <div class="col-md-12">
            <div class="showback">
                <table class="table table-striped table-advance table-hover">
                    <h4><i class="fa fa-angle-right"></i> Echange(s) simplement débuté(s) : <b><?=sizeof($tradesProposed)?></b></h4>
                    <p>Ici se trouvent les propositions d'échanges que vous avez mises en ligne, mais que personne n'a encore rejoint.</p>

                    <?php if( empty($tradesProposed) ) : ?>
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
                            <?php foreach( $tradesProposed as $trade ) : ?>
                            <tr>
                                <td class="mytrades-show-id"><?= $trade->id ?></td>
                                <td>
                                  <?= date('d/m/Y à H:i:s', $trade->dateBegin ) ?>
                                </td>
                                <td><?= sizeof($trade->cards) ?></td>
                                <td> 
                                    <button class="btn btn-primary btn-xs btn-mytrades-show" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye"></i> Voir</button> 
                                    <button class="btn btn-danger btn-xs btn-mytrades-delete"><i class="fa fa-ban"></i> Annuler</button> 
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    <?php endif; ?>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div><!-- row mt -->

    <div class="row mt">
        <div class="col-md-12">
            <div class="showback">
                <table class="table table-striped table-advance table-hover">
                    <h4><i class="fa fa-angle-right"></i> Echange(s) proposé(s) : <b><?=sizeof($tradesInProgressProposed)?></b></h4>
                    <p>Ici se trouvent les propositions d'échanges que vous avez mises en ligne, et que des utilisateurs ont rejoint.</p>

                    <?php if( empty($tradesInProgressProposed) ) : ?>
                        <thead>
                            <tr>
                                <td><i class="fa fa-warning"></i> Vous n'avez encore aucun échange en cours.</td>
                            <tr>
                        </thead>

                    <?php else : ?>

                        <thead>
                            <tr>
                                <th>ID de l'échange</th>
                                <th>Date de début</th>
                                <th>Nombre de cartes dans l'échange</th>
                                <th>Participant</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach( $tradesInProgressProposed as $trade ) : ?>
                            <tr>
                                <td class="mytrades-show-id"><?= $trade->id ?></td>
                                <td>
                                  <?= date('d/m/Y à H:i:s', $trade->dateBegin ) ?>
                                </td>
                                <td><?= sizeof($trade->cards) ?></td>
                                <td><?= $trade->seeker->firstNameSeeker.' '.$trade->seeker->lastNameSeeker ?></td>
                                <td> 
                                    <button class="btn btn-primary btn-xs btn-mytrades-show" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye"></i> Voir</button> 
                                    <button class="btn btn-success btn-xs btn-mytrades-accept"><i class="fa fa-check"></i> Accepter l'échange</button> 
                                    <button class="btn btn-danger btn-xs btn-mytrades-deny"><i class="fa fa-times"></i> Refuser l'échange</button> 
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    <?php endif; ?>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div><!-- row mt -->

    <div class="row mt">
        <div class="col-md-12">
            <div class="showback">
                <table class="table table-striped table-advance table-hover">
                    <h4><i class="fa fa-angle-right"></i> Echange(s) rejoint(s) : <b><?=sizeof($tradesInProgressJoined)?></b></h4>
                    <p>Ici se trouvent les propositions d'échanges mises en ligne par d'autres utilisateurs, et que vous avez rejoint.</p>

                    <?php if( empty($tradesInProgressJoined) ) : ?>
                        <thead>
                            <tr>
                                <td><i class="fa fa-warning"></i> Vous n'avez encore rejoint aucun échange.</td>
                            <tr>
                        </thead>

                    <?php else : ?>

                        <thead>
                            <tr>
                                <th>ID de l'échange</th>
                                <th>Date de début</th>
                                <th>Nombre de cartes dans l'échange</th>
                                <th>Propriétaire</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach( $tradesInProgressJoined as $trade ) : ?>
                            <tr>
                                <td class="mytrades-show-id"><?= $trade->id ?></td>
                                <td>
                                  <?= date('d/m/Y à H:i:s', $trade->dateBegin ) ?>
                                </td>
                                <td><?= sizeof($trade->cards) ?></td>
                                <td><?= $trade->firstNameGiver.' '.$trade->lastNameGiver ?></td>
                                <td> 
                                    <button class="btn btn-primary btn-xs btn-mytrades-show" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye"></i> Voir</button> 
                                    <button class="btn btn-danger btn-xs btn-mytrades-quit-seeker"><i class="fa fa-ban"></i> Quitter l'échange</button> 
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    <?php endif; ?>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div><!-- row mt -->

    <div class="row mt">
        <div class="col-md-12">
            <div class="showback">
                <table class="table table-striped table-advance table-hover">
                    <h4><i class="fa fa-angle-right"></i> Echange(s) terminé(s) : <b><?=sizeof($tradesEnded)?></b></h4>
                    <p>Ici se trouvent les échanges terminés : Annulés, Refusés ou Accomplis.</p>

                    <?php if( empty($tradesEnded) ) : ?>
                        <thead>
                            <tr>
                                <td><i class="fa fa-warning"></i> Vous n'avez encore rejoint aucun échange.</td>
                            <tr>
                        </thead>

                    <?php else : ?>

                        <thead>
                            <tr>
                                <th>ID de l'échange</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
                                <th>Donneur</th>
                                <th>Participant(e)</th>
                                <th>Libellé</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach( $tradesEnded as $trade ) : ?>
                            <tr>
                                <td class="mytrades-show-id"><?= $trade->id ?></td>
                                <td>
                                  <?= date('d/m/Y à H:i:s', $trade->dateBegin ) ?>
                                </td>
                                <td>
                                  <?= date('d/m/Y à H:i:s', $trade->dateEnd ) ?>
                                </td>
                                <td><?= $trade->firstNameGiver.' '.$trade->lastNameGiver ?></td>
                                <td><?= (isset($trade->seeker)) ? $trade->seeker->firstNameSeeker.' '.$trade->seeker->firstNameSeeker : 'Non défini(e)' ?></td>
                                <td><?= $trade->status ?></td>
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
