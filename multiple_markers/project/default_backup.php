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

$conn = mysqli_connect("localhost","root","root","googlemap");

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
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="sample_map.js">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvJWO9yPsyJH0PXCMP9fEr2gNowispJgA"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
    	var map;
		var infoWindow;

		var markersData = <?php echo json_encode($data); ?>;
		var markersArray = new Array();

		function initialize() {
		   var mapOptions = {
		      center: new google.maps.LatLng(37.401726,-122.114647),
		      zoom: 9,
		      mapTypeId: 'roadmap',
		   };

		   map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

		   infoWindow = new google.maps.InfoWindow();

		   google.maps.event.addListener(map, 'click', function() {
		      infoWindow.close();
		   });

		  markersArray = displayMarkers(markersData);
		}
		google.maps.event.addDomListener(window, 'load', initialize);


		
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
  <div id="map-canvas" style="width:40%;height:400px;margin-top: 50px;"></div>
  <ul>
  <?php foreach ($data as $key => $value) {
  	?><li><a href="#" itemid ="<?php echo $value['id'];?>" class="car-link"><?php echo $value['name'];?></a></li><?php 
  } ?>
  </ul>
  </body>
</html>