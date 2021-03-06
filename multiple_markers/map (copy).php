<?php /*$data = array(array("lat" => 40.6386333,
"lng" => -8.745,
"name" => "Camping Praia da Barra",
"address1" => "Rua Diogo Cão, 125",
"address2" => "Praia da Barra",
"postalCode" => "3830-772 Gafanha da Nazaré"),array("lat" => 40.59955,
"lng" => -8.7498167,
"name" => "Camping Costa Nova",
"address1" => "Quinta dos Patos, n.º 2",
"address2" => "Praia da Costa Nova",
"postalCode" => "3830-453 Gafanha da Encarnação"),array("lat" => 40.6247167,
"lng" => -8.7129167,
"name" => "Camping Gafanha da Nazaré",
"address1" => "Rua dos Balneários do Complexo Desportivo",
"address2" => "Gafanha da Nazaré",
"postalCode" => "3830-225 Gafanha da Nazaré"));*/

$conn = mysqli_connect("localhost","root","root","test");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$sql = "select * from markers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
//    echo json_encode($data);die;
} else {
    echo "0 results";
}
$conn->close();
?>

<!DOCTYPE html>
<html>
  <head>
  	<meta charset="utf-8">
  	<title>Bounsing marker</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvJWO9yPsyJH0PXCMP9fEr2gNowispJgA"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
    	// *
		// * Add multiple markers
		// * 2013 - en.marnoto.com
		// *

		// necessary variables
		var map;
		var infoWindow;

		// markersData variable stores the information necessary to each marker
		var markersData = <?php echo json_encode($data); ?>;
		var markersArray = new Array();

		function initialize() {
		   var mapOptions = {
		      center: new google.maps.LatLng(37.401726,-122.114647),
		      zoom: 9,
		      mapTypeId: 'roadmap',
		   };

		   map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

		   // a new Info Window is created
		   infoWindow = new google.maps.InfoWindow();

		   // Event that closes the Info Window with a click on the map
		   google.maps.event.addListener(map, 'click', function() {
		      infoWindow.close();
		   });

		   // Finally displayMarkers() function is called to begin the markers creation
		   displayMarkers();
		}
		google.maps.event.addDomListener(window, 'load', initialize);


		// This function will iterate over markersData array
		// creating markers with createMarker function
		function displayMarkers(){

		   // this variable sets the map bounds according to markers position
		   var bounds = new google.maps.LatLngBounds();
		   
		   // for loop traverses markersData array calling createMarker function for each marker 
		   for (var i = 0; i < markersData.length; i++){

		      var latlng = new google.maps.LatLng(markersData[i].lat, markersData[i].lng);
		      var name = markersData[i].name;
		      var address1 = markersData[i].address;
		      //var address2 = markersData[i].address2;
		      //var postalCode = markersData[i].postalCode;

		      markersArray[markersData[i].id] = createMarker(latlng, name, address1);          //, address2, postalCode

		      // marker position is added to bounds variable
		      bounds.extend(latlng);  
		   }

		   // Finally the bounds variable is used to set the map bounds
		   // with fitBounds() function
		   map.fitBounds(bounds);
		}

		// This function creates each marker and it sets their Info Window content
		function createMarker(latlng, name, address1){    //, address2, postalCode
		   var marker = new google.maps.Marker({
		      map: map,
		      position: latlng,
		      title: name,
		      icon: "http://uandmycar.com/templates/hoxa/images/sportscar.png",
		   });

		   google.maps.event.addListener(marker, 'click', function() {
		      var iwContent = '<div id="iw_container">' +
		            '<div class="iw_title">' + name + '</div>' +
		         '<div class="iw_content">' + address1 + '<br /></div></div>';
		      infoWindow.setContent(iwContent);
		   });
		   return marker;
		}
		function toggleBounce(mymarker,set) {
			if (set) {
				mymarker.setAnimation(null);
			} else {
				mymarker.setAnimation(google.maps.Animation.BOUNCE);
			}
		}
    </script>
    <script type="text/javascript">
    	jQuery(document).ready(function() {
		      jQuery(".car-link").mouseover(function() {
		          var markerID = jQuery(this).attr('itemid');
		          toggleBounce(markersArray[markerID],false);
		      }).mouseout(function (){
		           var markerID = jQuery(this).attr('itemid');
		          toggleBounce(markersArray[markerID],true);
		      });
		 });
    </script>
  </head>
  <body>
  <div id="map-canvas"></div>
  <ul>
  <?php foreach ($data as $key => $value) {
  	?><li><a href="#" itemid ="<?php echo $value['id'];?>" class="car-link"><?php echo $value['name'];?></a></li><?php 
  } ?>
  </ul>
  </body>
</html>
