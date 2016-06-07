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

	$('#form-search').submit( function(e, f){
		e.preventDefault();
		var $this = $(this);
		var idCardType = parseInt( $('#form-search-select').val() );

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
			$('.search-result').fadeIn();

		}).fail( function(data) {
			alert('Une erreur est survenue !');
			console.log(data);
		});
	});
});