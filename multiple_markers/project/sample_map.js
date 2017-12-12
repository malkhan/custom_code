function displayMarkers(markersData){alert();
    var markersArray = new Array();
		var bounds = new google.maps.LatLngBounds();
        var  i;
        var marker_id=new Array();
            for (i = 0; i < markersData.length; i++) {  
              marker = new google.maps.Marker({
              position: new google.maps.LatLng(markersData[i].lat, markersData[i].lng),
              map: map,
              icon: "http://uandmycar.com/templates/hoxa/images/sportscar.png",
              id:markersData[i].id
            });
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent(markersData[i].name);
              infowindow.open(map, marker);
            }
          })(marker, i));
          bounds.extend(marker.position);
          console.log(marker);
          markersArray[markersData[i].id] = marker;
        }
        map.fitBounds(bounds);
        return markersArray;
    	}

		function toggleBounce(mymarker,set) {
			if (set) {
				mymarker.setAnimation(null);
			} else {
				mymarker.setAnimation(google.maps.Animation.BOUNCE);
			}
		}