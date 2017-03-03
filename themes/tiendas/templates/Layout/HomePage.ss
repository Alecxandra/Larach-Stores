<div class="container container-map">
<div class="row">
	<div class="col col-md-4 markers">
		<% loop $Stores %>
			<div class="button_store" data-position="$Pos">
				$Name
			</div>
		<% end_loop %>
	</div>
	<div class="col col-md-8">
		<div id="store-map"></div>
	</div>
</div>

</div>

<script type="text/javascript">

	var map;
	var markerCount = 1;
	var markers = new Array();
	function initMap() {
		var myLatLng = {lat: 14.1052970000, lng: -87.2057520000};

		var map = new google.maps.Map(document.getElementById('store-map'), {
			zoom: 18,
			center: myLatLng
		});

		<% loop $Stores %>
			console.log('$Name');
			console.log(markerCount);
			var infowindow = new google.maps.InfoWindow();
			var marker = new google.maps.Marker({
				position: {lat: {$Latitude}, lng: {$Longitude}},
				map: map,
				icon: '$ThemeDir/images/marker-larach.png',
				title: ''
			});



			google.maps.event.addListener(marker, 'click', (function(marker, markerCount) {
				return function() {
					infowindow.setContent('<h2>{$Name.RAW}</h2><hr><div>{$Address.HTML}</div>');
					infowindow.open(map, marker);
				}
			})(marker, markerCount));
			markers.push(marker);
			markerCount++;
		<% end_loop %>

	}

	$('.button_store').on('click', function(){
	    console.log($(this).data('position'));
		google.maps.event.trigger(markers[$(this).data('position')-1], 'click');
	});

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAewcxUby-MRieeSRBf0CmxVRU0U9xgNik&callback=initMap">
</script>
