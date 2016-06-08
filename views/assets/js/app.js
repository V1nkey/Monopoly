$(document).ready(function(){
	$('.btn-propose').click(function(){
		$this = $(this);
		
		if( $this.attr('data') == "plus" )
			var row = $this.closest("tr.table-yourcollection");	
		else
			var row = $this.closest("tr.table-yourproposition");	
			
		row.toggleClass("table-yourcollection").toggleClass("table-yourproposition");
		$this.find("i").toggleClass("fa-plus").toggleClass("fa-minus");
		$this.toggleClass("btn-success").toggleClass("btn-danger");
		$this.toggleClass("btn-propose-minus").toggleClass("btn-propose-plus");

		var prevYourProposition = parseInt( $('.table-yourproposition-count').html() );
		var prevYourCollection = parseInt( $('.table-yourcollection-count').html() );

		if( $this.attr('data') == "plus" ) {
			$('table.table-yourproposition').append(row);
			$this.attr('data', "minus");

			var newYourCollection = prevYourCollection - 1;
			var prevYourProposition = prevYourProposition + 1;
		} else {
			$this.attr('data', "plus");
			$('table.table-yourcollection').append(row);

			var newYourCollection = prevYourCollection + 1;
			var prevYourProposition = prevYourProposition - 1;
		}

		$('b.table-yourcollection-count').html( newYourCollection );
		$('b.table-yourproposition-count').html( prevYourProposition );
	});

	$('.btn-propose-submit').click(function(e){
		e.preventDefault();

		if( $('table.table-yourproposition > tbody > tr').size() == 0 )
			alert("Ajoutez des cartes à votre proposition d'abord !");
		else {
			var ids = [];
			$('table.table-yourproposition > tbody > tr').each(function() {
				$this = $(this);
				var idCard = parseInt( $this.find("td.table-yourcollection-id").html() );
				ids.push(idCard);
			});

			var jsonString = JSON.stringify(ids);

			$.ajax({
				type: "POST",
				url: "ajax/createNewProposition.php",
				data: { data: jsonString }
			}).done( function(data) {
				alert(" Proposition mise en ligne avec succès ! ");
				document.location.href = "mytrades.php";
			});
		}
	});

	$('.btn-mytrades-show').click( function(e) {
		e.preventDefault();

		var $this = $(this);
		var row = $this.closest('tr');
		var id = parseInt( row.find("td.mytrades-show-id").html() );
		
		// Effacement de toutes les lignes du tableau
		$("table.mytrades-show").find("tr").remove();

		// Changement de l'ID dans le titre de la fenetre modale
		$('#mytrades-show-id').html("#" + id);

		// Ajout des lignes au tableau 
		$.ajax({
			type: "POST",
			url: "ajax/getCardsInTradeById.php",
			data: {data: id}
		}).done( function(data) {
			if( data.status == 'success' ) {
				$( data.data ).each( function(k,v) {
					var card = data.data[k] ;

					var card_id = card.id;
					var card_label = card.label;
					var card_color = card.color;

					var newRow = "<tr> <td>" + card_id + "</td> <td>" + card_label + "</td> <td><span class='label label-" + card_color + "'><i class='fa fa-circle'></i></span></td> </tr>";
					$('table.mytrades-show').append( newRow );
				});
			} else {
				alert( data.message );
			}
		}).fail( function(data) {
			alert('Une erreur est survenue <br>');
			console.log(data);
		});
	});

	$('.btn-mytrades-delete').click( function(e) {
		e.preventDefault();

		var $this = $(this);
		var row = $this.closest('tr');
		var id = parseInt( row.find("td.mytrades-show-id").html() );

		// Ajout des lignes au tableau 
		$.ajax({
			type: "POST",
			url: "ajax/deleteTradeById.php",
			data: {data: id},
			beforeSend: function() {
				$this.find("i").removeClass("fa-ban");
				$this.find("i").addClass("fa-refresh");
			}

		}).always( function(){
				$this.find("i").removeClass("fa-refresh");
				$this.find("i").addClass("fa-ban");	

		}).done( function(data) {
			if( data.status == 'success' ) {
				row.fadeOut();
				document.location.href = "mytrades.php";
			} else {
				alert( data.message );
			}

		}).fail( function(data) {
			alert('Une erreur est survenue <br>');
			console.log(data);
		});
	});

	$('.btn-search-show').live("click", function(e) {
		e.preventDefault();

		var $this = $(this);
		var row = $this.closest('tr');
		var idCardType = parseInt( row.find("td.search-show-id").html() );

		// Effacement de toutes les lignes du tableau
		$("table.search-trade-show").find("tbody").remove();

		// Changement de l'ID dans le titre de la fenetre modale
		$('#search-show-id').html("#" + idCardType);

		// Ajout des lignes au tableau 
		$.ajax({
			type: "POST",
			url: "ajax/getCardsInTradeById.php",
			data: {data: idCardType}
		}).done( function(data) {
			if( data.status == 'success' ) {
				$( data.data ).each( function(k,v) {
					var card = data.data[k] ;

					var card_id = card.id;
					var card_label = card.label;
					var card_color = card.color;

					var newRow = "<tr> <td>" + card_id + "</td> <td>" + card_label + "</td> <td><span class='label label-" + card_color + "'><i class='fa fa-circle'></i></span></td> </tr>";
					$('table.search-trade-show').append( newRow );
				});
			} else {
				alert( data.message );
			}
		}).fail( function(data) {
			alert('Une erreur est survenue <br>');
			console.log(data);
		});
	});

	$('.btn-admin').click( function(e) {
		e.preventDefault();

		var $this = $(this);
		var row = $this.closest('tr');
		var id = parseInt(row.find("td.table-users-id").html());
		var admin = ($this.attr('data') == "upgrade") ? 1 : 0;

		$.ajax({
			type: "POST",
			url: "ajax/toggleUserStatus.php",
			data: {id : id, admin : admin}
		}).done (function(data) {
			document.location.href = "admin.php#users";
		}).fail (function(data) {
		});
	});

	$('#form-search').submit( function(e){
		e.preventDefault();
		var $this = $(this);
		var idCardType = parseInt( $('#form-search-select').val() );

		// Effacement de toutes les lignes du tableau
		$("table.search-show").find("tbody").remove();

		$.ajax({
			type: "POST",
			url: "ajax/getProposesByIdCard.php",
			data: {data: idCardType},
			beforeSend: function() {
				$this.find("i").removeClass("fa-ban");
				$this.find("i").addClass("fa-refresh");
			}

		}).done( function(data){
			$('#search-result-nb').html( data.data.length );
			
			if( data.data.length > 0 ) {
				$( data.data ).each( function(k,v) {
					var trade = data.data[k];
					var cards = trade.cards;

					var trade_id = trade.id;
					var trade_lastname = trade.lastname;
					var trade_firstname = trade.firstname;

					if( cards.length > 1 ) {
						var btn_show = "<td><button class='btn btn-primary btn-xs btn-search-show' data-toggle='modal' data-target='#myModal'><i class='fa fa-eye'></i> Voir les <b>"+cards.length+"</b> cartes </button></td>";
					}
					else {
						var btn_show = "<td><button class='btn btn-primary btn-xs btn-search-show' data-toggle='modal' data-target='#myModal'><i class='fa fa-eye'></i> Voir la carte </button></td>";	
					}

					var btn_beginTrade = "<td><button class='btn btn-theme02 btn-xs btn-search-beginTrade'><i class='fa fa-exchange'></i> Commencer l'échange</button></td>";

					var newRow = "<tr> <td class='search-show-id'>" + trade_id + "</td> <td>" + trade_firstname + " " + trade_lastname + "</td> " + btn_show + btn_beginTrade + " </tr>";

					$('table.search-show').append( newRow );	
				});
			} else {
				var newRow = "<tr> <td colspan=4> Aucun utilisateur ne propose encore cette carte </td> </tr>"
				$('table.search-show').append( newRow );	
			}

			$('.search-result').fadeIn();

		}).fail( function(data) {
			alert('Une erreur est survenue !');
			console.log(data);
		});
	});

	$('.btn-search-beginTrade').live("click", function(e) {
		e.preventDefault();

		var $this = $(this);
		var row = $this.closest('tr');
		var idTrade = parseInt( row.find("td.search-show-id").html() );

		$('.trade-id').html('#'+idTrade);
		$('.search-togive').fadeIn();
	});

	$('.btn-search-propose-submit').click( function(e) {
		e.preventDefault();

		var idTrade = parseInt( $(".search-show-id").html() );

		if( $('table.table-yourproposition > tbody > tr').size() == 0 )
			alert("Ajoutez des cartes à votre proposition d'abord !");
		else {
			var ids = [];
			$('table.table-yourproposition > tbody > tr').each(function() {
				$this = $(this);
				var idCard = parseInt( $this.find("td.table-yourcollection-id").html() );
				ids.push(idCard);
			});

			var jsonString = JSON.stringify(ids);

			$.ajax({
				type: "POST",
				url: "ajax/beginNewTrade.php",
				data: { data: jsonString, idTrade : idTrade }
			}).done( function(data) {
				alert(" Proposition mise en ligne avec succès ! ");
				document.location.href = "mytrades.php";
			});
		}
	});

	$('#form-cardsByUser').submit( function(e){
		e.preventDefault();
		var $this = $(this);
		var idUser = parseInt( $('#form-cardsByUser-select').val() );

		// Effacement de toutes les lignes du tableau
		$("table.cardsByUser-show").find("tbody").remove();

		$.ajax({
			type: "POST",
			url: "ajax/getCardsByUser.php",
			data: {data: idUser},
			beforeSend: function() {
				$this.find("i").removeClass("fa-ban");
				$this.find("i").addClass("fa-refresh");
			}

		}).done( function(data){
			$('#cardsByUser-result-nb').html( data.data.length );
			
			if( data.data.length > 0 ) {
				$( data.data ).each( function(k,v) {
					var card = data.data[k];

					var card_id = card.id;
					var card_label = card.label;
					var card_color = card.color;
					var card_status = card.status;

					var newRow = "<tr> <td>" + card_id + "</td> <td>" + card_label + 
								"</td> <td> <span class='label label-" + card_color + "'><i class='fa fa-circle'></i></span> </td> " +
								"<td>" + card_status + "</td></tr>";

					$('table.cardsByUser-show').append( newRow );	
				});
			} else {
				var newRow = "<tr> <td colspan=4> Cet utilisateur ne dispose d'aucune carte </td> </tr>"
				$('table.cardsByUser-show').append( newRow );	
			}

			$('.search-result').fadeIn();

		}).fail( function(data) {
			alert('Une erreur est survenue !');
			console.log(data);
		});
	});
});
