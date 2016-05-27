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
				url: "createNewProposition.php",
				data: { data: jsonString }
			}).done( function(data) {
				alert(data.message);
			});
		}
	});
});