<section id="main-content">
  	<section class="wrapper site-min-height">
	    <h3><i class="fa fa-angle-right"></i> <?= $page_title ?></h3>

	    <div class="row mt">
	      	<div class="col-sm-12" >
		        <div class="showback">
		            <h4><i class="fa fa-angle-right"></i> Liste des membres : </h4>
		            <table class="table table-striped table-advance table-hover table-yourcollection"> 
		            	<thead>
		                    <tr>
		                        <th>#</th>
		                        <th>Nom</th>
		                        <th>Statut</th>
		                        <th>Action</th>
		                    </tr>
		                </thead> 
		                <tbody>
		                	<?php while($users = $dataUsers->fetch()) : ?>
			                	<tr class="table-users">
			            			<td class="table-users-id" ><?= $users["id"]; ?></td>
			            			<td><?= $users["lastname"]." ".$users["firstname"]; ?></td>
		            			<?php if ($users["admin"] == 0) : ?>
			                        <td>Membre</td>
			                        <td> <button class="btn btn-success btn-xs btn-admin" data="upgrade"><i class="fa fa-plus"></i> Promouvoir</button></td>
		                        <?php else : ?>
		                        	<td>Admin</td>
			                        <td> <button class="btn btn-danger btn-xs btn-admin" data="downgrade"><i class="fa fa-minus"></i> Rétrograder</button></td>
		                        <?php endif; ?>
		                    	</tr>
		                    <?php endwhile; ?>
		                </tbody>
		            </table>
		        </div> <!-- showback -->
		    </div> <!-- col-sm-12 -->
		</div> <!-- row mt -->

		<div class="row mt" id="trades">
	      	<div class="col-sm-12">
		        <div class="showback">
		            <h4><i class="fa fa-angle-right"></i> Liste des transactions effectuées : </h4>
		            <table class="table table-striped table-advance table-hover table-yourcollection"> 
		            	<thead>
		                    <tr>
		                        <th>Donneur</th>
		                        <th>Cartes données</th>
		                        <th>Cartes reçues</th>
		                        <th>Receveur</th>
		                    </tr>
		                </thead> 
		                <tbody>
		                	<?php foreach($dataTrades as $trade) : ?>
		                	<?php $i = 0; ?>
		                	<?php $nbLines = maximum(sizeof($trade->givenCards), sizeof($trade->receivedCards)); ?>
			                	<tr class="table-trades">
			            			<td rowspan=<?= $nbLines + 1; ?>><?= $trade->givers->lastname." ".$trade->givers->firstname; ?></td>
			            			<?php while($i <= $nbLines) : ?>
				            				<?php if (!empty($trade->givenCards[$i])) : ?>
				            					<td><?= $trade->givenCards[$i]->label; ?></td>
			            					<?php else : ?>
			            						<td></td>
		            						<?php endif; ?>

				            				<?php if (!empty($trade->receivedCards[$i])) : ?>
				            					<td><?= $trade->receivedCards[$i]->label; ?></td>
			            					<?php else : ?>
			            						<td></td>
		            						<?php endif; ?>
	            						<?php if ($i == 0) : ?>
	            							<td rowspan=<?= $nbLines + 1; ?>><?= $trade->seekers->lastname." ".$trade->seekers->firstname; ?></td>
            							<?php endif; ?>
            							<?php $i++; ?>
            							</tr>
            							<tr>
            						<?php endwhile; ?>
	            				</tr>
		                    <?php endforeach; ?>
		                </tbody>
		            </table>
		        </div> <!-- showback -->
		    </div> <!-- col-sm-12 -->
		</div> <!-- row mt -->

		<div class="row mt" id="cards">
	      	<div class="col-sm-12">
		        <div class="showback">
		            <h4><i class="fa fa-angle-right"></i> Liste des cartes des membres : </h4>
		            <form class="form-horizontal style-form" id='form-cardsByUser' method="post" action=" ">
		            	<div class="form-group">
		            		<label class="col-sm-2 control-label">Liste des membres</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="form-cardsByUser-select" name="idUser">
                                    <?php while ($users = $dataUsers2->fetch()) : ?>
                                        <option value="<?=$users['id'];?>"><?=$users["lastname"]." ".$users["firstname"]; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type"submit" class="btn btn-theme04"><i class="fa fa-angle-double-down"></i> Afficher les cartes</button>
                            </div>
                        <div>
                	</form>
		        </div> <!-- showback -->
		    </div> <!-- col-sm-12 -->
		</div> <!-- row mt -->

		<div class="row mt cardsByUser-result">
        <div class="col-md-12">
            <div class="showback">
                <table class="table table-striped table-advance table-hover cardsByUser-show">
                    <h4><i class="fa fa-angle-right"></i> Résultat de la recherche : <b id="cardsByUser-result-nb">0</b></h4>

                    <thead>
                        <tr>
	                        <th>ID</th>
	                        <th>Nom de carte</th>
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
