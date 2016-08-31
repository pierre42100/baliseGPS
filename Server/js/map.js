function initLevelMap() {
	var latlng = [currentPos.latitude, currentPos.longitude];

	// map
	levelMap = L.map('levelMap')
		.addLayer(new L.TileLayer(
			'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
			{ attribution: 'Map data © OpenStreetMap contributors - Hosted by the Service Pierre' }
		))
		.setView(latlng, 19)
		.on('dragstart', function() {
			levelMap.closePopup();
		})
		.on('click', function(e){
			if(levelMap.popup._isOpen) {	// if popup is open, close it
				levelMap.closePopup();
				return;
			}
			currentPos = { latitude: e.latlng.lat, longitude: e.latlng.lng };
			moveCircles();
		});

	// marker
	levelMap.marker = new L.marker(latlng, { draggable: true })
		.addTo(levelMap)
		.on('click', function() {
			showPopup(levelMap);
		})
		.on('drag', function(e) {
			currentPos = { latitude: e.target._latlng.lat, longitude: e.target._latlng.lng };
			moveCircles();
		});

	

	// circles (accuracy circle first to be on bottom)
	levelMap.accuracy = new L.Circle(latlng, 10, {
			color: null,
			fillColor: 'blue',
			fillOpacity: 0.4,
			clickable: false,
		})
		.addTo(levelMap);

	levelMap.protection = new L.Circle(latlng, 5, {
			color: null,
			fillColor: '#f03',
			fillOpacity: 0.4,
			clickable: false,
		})
		.addTo(levelMap);
}

function moveCircles() {
	var latlng = [currentPos.latitude, currentPos.longitude];

	levelMap.marker.setLatLng(latlng);
	levelMap.protection.setLatLng(latlng);
	levelMap.accuracy.setLatLng(latlng);
}

function initPages() {
	$(document).on("pagecontainershow", function(e, ui) {
			initLevelMap();	
	});
}

// set page events before "ready"
//
initPages();
