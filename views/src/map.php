<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<style type="text/css">
		html, body, #map-canvas { height: 100%; margin: 0; padding: 0;}
	</style>
	 <!-- Bootstrap core CSS -->
    <link href="view/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="view/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="view/assets/css/style.css" rel="stylesheet">
    <link href="view/assets/css/style-responsive.css" rel="stylesheet">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyBHCse21R9FtDTrRnTsMvm8sKuMsva6uWw"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script>
	$(document).ready(function(){
		var map ;

    	var infowindow;

		google.maps.Map.prototype.markers = new Array();
		    
		google.maps.Map.prototype.addMarker = function(marker) {
		    this.markers[this.markers.length] = marker;
		};
		    
		google.maps.Map.prototype.getMarkers = function() {
		    return this.markers;
		};
		    
		google.maps.Map.prototype.clearMarkers = function() {
		    if(infowindow) {
		      infowindow.close();
		    }
		    
		    for(var i=0; i< this.markers.length; i++){
		      this.markers[i].setMap(null);
		    }
		};

		function initialize() {
	    		var lieux = [] ;

	        	var styles = [
				  {
				    "featureType": "poi",
				    "stylers": [
				      { "visibility": "off" }
				    ]
				  },{
				    "featureType": "poi.school",
				    "stylers": [
				      { "visibility": "on" }
				    ]
				  },{
				    "featureType": "poi.government",
				    "stylers": [
				      { "visibility": "on" }
				    ]
				  },{
				    "featureType": "poi.park",
				    "stylers": [
				      { "visibility": "on" }
				    ]
				  },{
				    "featureType": "poi.sports_complex",
				    "stylers": [
				      { "visibility": "on" }
				    ]
				  },{
				    "featureType": "landscape.man_made"  }
				];

				var styledMap = new google.maps.StyledMapType(styles, {name: "Styled Map"});

				var mapOptions = {
	        		center: { lat: 45.5242118, lng: -73.526829},
	        		panControl:true,
	        		mapTypeControlOptions: {
	        			mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
	        		},
	        		zoom: 12
	        	};

	        	map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);

	        	map.mapTypes.set('map_style', styledMap);
	        	map.setMapTypeId('map_style');
		        
		        

		        $.getJSON('./getLieuxJson.php', function(json) {
	        		$.each(json, function( index, value ) {
	    				
	    				var lieu = new Object();
						lieu.name = json[index].name ;
						lieu.adresseCp = json[index].adresseCp ;
						lieu.adresseNum = json[index].adresseNum ;
						lieu.adresseRue = json[index].adresseRue ;
						lieu.adresseVille = json[index].adresseVille ;
						lieu.id = json[index].id ;
						lieu.lat = parseFloat(json[index].lat);
						lieu.lon = parseFloat(json[index].lng);
						lieu.type = json[index].type ;

						lieux.push(lieu);
					});

					$.each(lieux, function(i, value) {
						
				        map.addMarker(createMarker(lieux[i], lieux[i].lat,lieux[i].lon));
					});
	        	});
          	}

          	function createMarker(lieu, lat,lng) {
				var pin = {
					url:'./img/marker_blue.png',
					size: new google.maps.Size(25,40),
					origin: new google.maps.Point(0,0),
					anchor: new google.maps.Point(12,30)
				};

			    var latLng = new google.maps.LatLng(lat, lng); 

			    var marker = new google.maps.Marker({
			    	position: latLng,
			    	map: map
			    });


			   var contentString = 
			    '<div id="content">' +
				'<div id="siteNotice">' +
				'</div>' +
				'<p><h3 id="firstHeading" class="firstHeading">' + 
				lieu.name + '</h3>' +
				'<div id="bodyContent"></p>' +
				'<p><b>Adresse : </b>' + lieu.adress + '<br><b>Type :</b> '+ lieu.type
				'</p></div>'+
				'</div>';

			    google.maps.event.addListener(marker, "click", function() {
			      	if (infowindow) infowindow.close();
			      	infowindow = new google.maps.InfoWindow({
			      		content: contentString
			     	});
			      	infowindow.open(map, marker);
			    });
			    return marker;
			}

          	google.maps.event.addDomListener(window, 'load', initialize);
	});
	</script>
</head>


	<body style="margin-top:50px;">
		<a class="btn btn" href="../index.php">Retour Site</a>
		<div id="map-canvas"></div>
		<div id="content"></div>
	</body>



	
</html>


