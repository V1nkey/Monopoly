$(document).ready(function(){
	$('.btn-propose').click(function(){
		$this = $(this);
		
		if( $this.attr('data') == "plus" )
			var row = $this.closest("tr.table-yourcollection");	
		else
			var row = $this.closest("tr.table-yourproposition");	
			
		row.toggleClass("table-yourcollection").toggleClass("table-yourproposition");
		console.log(row);
		$this.find("i").toggleClass("fa-plus").toggleClass("fa-minus");
		$this.toggleClass("btn-success").toggleClass("btn-danger");
		$this.toggleClass("btn-propose-minus").toggleClass("btn-propose-plus");

		if( $this.attr('data') == "plus" ) {
			$('table.table-yourproposition').append(row);
			$this.attr('data', "minus");
		} else {
			$this.attr('data', "plus");
			$('table.table-yourcollection').append(row);
		}
	});

	$('.btn-propose-submit').click(function(e){
		e.preventDefault();

		if( $('table.table-yourproposition > tbody > tr').size() == 0 )
			alert("Ajoutez des cartes à votre proposition d'abord !");
		else
			$('table.table-yourproposition > tbody > tr').each(function(key,value) {
				var row = new Object(value);
				var idCard = parseInt( value.find("td.table-yourcollection-id").html() );
				console.log(idCard);
			});
	});
});