<?php include('apiform.php');?>
<?php include('layout/header.php');?>
<?php
    /*Fetching Map Key form settings.ini*/
    $dataMap = parse_ini_file("../config/settings.ini", true);
    $mapKey = $dataMap['GOOGLE_MAP_KEY'];
?>
<body>
    <header class="text-center">
        <h1 class="heading"> LiveEnsure<sup>&reg;</sup> SDK</h1>
        <!-- <p class="sub-heading"> Real-time authentication solution demo with your mobile device. </p> -->
    </header>

    <div id="content">
        
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <ul class="nav navbar-nav">
	      <li><a href="device.php">Device</a></li>
	      <li><a href="knowledge.php">Knowledge</a></li>
	      <li  class="active"><a href="location.php">Location</a></li>
	      <!-- <li><a href="behaviour.php">Behaviour</a></li> -->
        <li><a href="bio.php">Bio</a></li>
        <li><a href="time.php">Time</a></li>
        <li><a href= "behaviour_v6.php">Behaviour</a></li>

	    </ul>
	  </div>
	</nav>
	<div class = "col-sm-3">
	<form id="email-form">
	  <div class="form-group form-group-modified">
	  <div class="row">
	  	<div class="col-sm-12">
	    <label for="email">1. Enter your Email and latitude/longitude</label>
	    <div class = "add-input">
	    	<span class = "add-on"><i class="fa fa-envelope"></i></span>
	    	<input type="email" name="email" class="form-control form-control-changes" id="email">
	    </div>
	  </div>
	  </div>
	  </div>
	  </form>
            <form id="location-form">
	  <div class="form-group form-group-modified">
	   <div class="row row-margin">
	  	<div class="col-sm-12">	
	  		<input type="hidden" name="sessionToken" id="location-sessionToken"/>
	    	<input name="lat" id="lat" class="form-control form-control-width" type="text" placeholder="lat" value="">
	    	<input name="long" id="long" class="form-control form-control-width" type="text" placeholder="Long" value="">
        <input name="selectedRadius" id="radius" type="hidden" >
                <div class="row row-margin col-sm-12">
                <input type="radio" id="in" name="inOut" value="true" checked>
                <label for="in">In</label>
                <input type="radio" id="out" name="inOut" value="false">
                <label for="out">Out</label>
                </div>
	    	<button id="submit" class="btn btn-default pull-right btn-modified marginTop-20 marginRight-5">Login</button>
	  	</div>
	  </div>
	  <div class="row row-margin">
	  	<div class="col-sm-12">	
	  		<div id="dvMap" class="map-container marginTop-40"><h3>Loading...</h3></div>
	  		</div>
	  		<a href="#" class ="pull-left marginLeft-15 marginTop-10 anchor-color"> Remember </a>
	  		<a href="#" class ="pull-right marginRight-15 marginTop-10 anchor-color"> Reset </a>
	  	</div>
	  </div>		
	</form>
        </div>
            <div class = "col-sm-3 marginLeft-xs-15">
                <p> <strong> 2. Scan and Authenticate </strong> </p>
                <img id="qr-img" src = "">
                <img style="margin-left: 20px" id="result-img" src = "" class = "marginTop-40">
            </div>
	

    
    <form class = "col-sm-6">
      <div class="form-group form-group-modified">
      <div class="row">
        <div class="col-sm-12">
            <h2> Debug Console </h2>
        </div>
      </div>    
      <div class="row row-margin">
        <div class="col-sm-12"> 
            <label class ="label-modify" for="url">Host URL:</label>
            <input value="https://app.liveensure.com/live-identity" readonly class="form-control form-control-width-change" type="text">
        </div>
      </div>
       <div class="row row-margin">
        <div class="col-sm-12">
        <label class ="label-modify" for="request">Request:</label>
        <textarea id="request-box" class="form-control form-control-width-change" rows="5"></textarea>
        </div>
      </div>
      <div class="row row-margin">
        <div class="col-sm-12">
            <label class ="label-modify" for="polling">Polling Status:</label>
            <input id="polling-status-ip" class="form-control form-control-width-change" type="text">
        </div>
      </div>
      <div class="row row-margin">
        <div class="col-sm-12">
        <label class ="label-modify" for="response">Response:</label>
        <textarea id="response-box" class="form-control form-control-width-change" rows="5"></textarea>
        </div>
      </div>
      </div>
    </form>
    </div> 
    <div class="row marginLeft-Right-0">
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo $mapKey;?>"></script>
        <script type="text/javascript">
$(document).ready(function() {
    console.log("Checking geolocation", navigator.geolocation.getCurrentPosition);
    if (navigator.geolocation) {
        console.log("Geolocation service is there.");
        navigator.geolocation.getCurrentPosition(function(p) {
            console.log("Called this with geolocation", p);
            var LatLng = new google.maps.LatLng(p.coords.latitude, p.coords.longitude);
            var mapOptions = {
                center: LatLng,
                zoom: 13,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
            var marker = new google.maps.Marker({
                position: LatLng,
                map: map,
                title: "<div style = 'height:60px;width:200px'><b>Your location:</b><br />Latitude: " + p.coords.latitude + "<br />Longitude: " + p.coords.longitude
            });
            google.maps.event.addListener(marker, "click", function(e) { 
                var infoWindow = new google.maps.InfoWindow();
                infoWindow.setContent(marker.title);
                infoWindow.open(map, marker);
            });

            google.maps.event.addListener(map, "click", function(e) { 
                $("#lat").val(e.latLng.lat());
                $("#long").val(e.latLng.lng());
                $("#radius").val(10);
            });
            $("#lat").val(p.coords.latitude);
            $("#long").val(p.coords.longitude);
            $('#radius').val(10);
        }, function() {
            var LatLng = new google.maps.LatLng('37.0902', '95.7129');
            var mapOptions = {
                center: LatLng,
                zoom: 2,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);

            google.maps.event.addListener(map, "click", function(e) { 
                $("#lat").val(e.latLng.lat());
                $("#long").val(e.latLng.lng());
                $('#radius').val(2);
            });
            alert("Could not find your current location");

        });
    } else {
        alert('Geo Location feature is not supported in this browser.');
    }
    $("#submit").click(function(e) {
        e.preventDefault();
        makeInitSessionCall().then(addLocationChallenge).then(getQRCode).then(poll);
    });
});
</script>
<?php include('layout/footer.php');?>