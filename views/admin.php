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
		                	<?php foreach($dataTrades as $trades) : ?>
	                		<?php $index = 0; ?>
			                	<tr class="table-trades">
			            			<td><?= $trades[$index]["givers"]["lastname"]." ".$trades[$index]["givers"]["firstname"]; ?></td>
		            				<td><?= $trades[$index]["givenCards"]["label"]; ?></td>
		            				<td><?= $trades[$index]["receivedCards"]["label"]; ?></td>
		                    		<td><?= $trades[$index]["seekers"]["lastname"]." ".$trades[$index]["seekers"]["firstname"]; ?></td>
	            				</tr>
            				<?php $index++; ?>
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
		            <form class="form-horizontal style-form" method="post" action=" ">
		            	<div class="form-group">
		            		<label class="col-sm-2 control-label">Liste des membres</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="idUser">
                                    <?php while ($users = $dataUsers2->fetch()) : ?>
                                        <option value="<?=$users['id'];?>"><?=$users["lastname"]." ".$users["firstname"]; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        <div>
                	</form>
		        </div> <!-- showback -->
		    </div> <!-- col-sm-12 -->
		</div> <!-- row mt -->
	</section>
</section>
