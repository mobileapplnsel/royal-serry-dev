<?php
//echo '<pre>'; print_r($userPickupOrderList);echo '</pre>'; //die;
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  $this->load->view('admin/include/header');
?>
<style type="text/css">
#container {
  height: 600px;
  display: flex;
}

#sidebar {
  flex-basis: 15rem;
  flex-grow: 1;
  padding: 1rem;
  max-width: 30rem;
  height: 100%;
  box-sizing: border-box;
  overflow: auto;
}

#map {
  flex-basis: 0;
  flex-grow: 4;
  /*height: 100%;*/
}

#directions-panel {
  margin-top: 10px;
}
.custom-map-control-button {
  background-color: #fff;
  border: 0;
  border-radius: 2px;
  box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
  margin: 10px;
  padding: 0 0.5em;
  font: 400 18px Roboto, Arial, sans-serif;
  overflow: hidden;
  height: 40px;
  cursor: pointer;
}
.custom-map-control-button:hover {
  background: #ebebeb;
}
</style>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php
            $this->load->view('admin/include/sidebar');
			//echo '<pre>'; print_r($editVidResolution); echo '</pre>';
        ?>
        <div class="content-wrapper">
            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php } ?>
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>
                    <?= $this->session->flashdata('success'); ?>
                </div>
            <?php } ?>
            <section class="content-header">
                <h1>
                    Map Direction
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= base_url('admin/pickup-order-list') ?>"><i class="fa fa-dashboard"></i>Pickup Order List</a></li>
                    <li class="active"> Map Direction</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Google Map Direction</h3>
                            </div>
                            <div class="box-body">
                                
    						<div id="container">
                              <div id="map"></div>
                              <div id="sidebar">
                                <div>
                                  <b>Start:</b>
                                  <select id="start">
                                    <!--<option value="Halifax, NS">Halifax, NS</option>
                                    <option value="Boston, MA">Boston, MA</option>
                                    <option value="New York, NY">New York, NY</option>
                                    <option value="Miami, FL">Miami, FL</option>-->
                                    <?php
                                        if(!empty($userPickupOrderList)){
                                        foreach($userPickupOrderList as $userPickup){
                                    ?> 
                                    <option value="<?php echo $userPickup->from_address.', '.$userPickup->city_name.', '.$userPickup->state_name.', '.$userPickup->country_name;?>"><?php echo $userPickup->from_address.', '.$userPickup->city_name.', '.$userPickup->state_name.', '.$userPickup->country_name;?></option>
                                    <?php }
                                    }?>
                                  </select>
                                  <br />
                                  <b>Waypoints:</b> <br />
                                  <i>(Ctrl+Click or Cmd+Click for multiple selection)</i> <br />
                                  <select multiple id="waypoints">
                                    <!--<option value="montreal, quebec">Montreal, QBC</option>
                                    <option value="toronto, ont">Toronto, ONT</option>
                                    <option value="chicago, il">Chicago</option>
                                    <option value="winnipeg, mb">Winnipeg</option>
                                    <option value="fargo, nd">Fargo</option>
                                    <option value="calgary, ab">Calgary</option>
                                    <option value="spokane, wa">Spokane</option>-->
                                    <?php
                                        if(!empty($userPickupOrderList)){
                                        foreach($userPickupOrderList as $userPickup){
                                    ?> 
                                    <option value="<?php echo $userPickup->from_address.', '.$userPickup->city_name.', '.$userPickup->state_name.', '.$userPickup->country_name;?>"><?php echo $userPickup->from_address.', '.$userPickup->city_name.', '.$userPickup->state_name.', '.$userPickup->country_name;?></option>
                                    <?php }
                                    }?>
                                  </select>
                                  <br />
                                  <b>End:</b>
                                  <select id="end">
                                    <!--<option value="Vancouver, BC">Vancouver, BC</option>
                                    <option value="Seattle, WA">Seattle, WA</option>
                                    <option value="San Francisco, CA">San Francisco, CA</option>
                                    <option value="Los Angeles, CA">Los Angeles, CA</option>-->
                                    <?php
                                        if(!empty($userPickupOrderList)){
                                        foreach($userPickupOrderList as $userPickup){
                                    ?> 
                                    <option value="<?php echo $userPickup->from_address.', '.$userPickup->city_name.', '.$userPickup->state_name.', '.$userPickup->country_name;?>"><?php echo $userPickup->from_address.', '.$userPickup->city_name.', '.$userPickup->state_name.', '.$userPickup->country_name;?></option>
                                    <?php }
                                    }?>
                                  </select>
                                  <br />
                                  <input type="submit" id="submit" />
                                </div>
                                <div id="directions-panel"></div>
                              </div>
                            </div>

                            <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
                            <script
                              src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmUohDE70gjqrjgFEbhtyjPOhn9WBghuo&callback=initMap&libraries=&v=weekly&channel=2"
                              async
                            ></script>
                            
                                
                            </div>                    
                        </div>
                        <div class="box">
                            
                        </div>
                    </div>            
                </div>
            </section>
        </div>
<script type="text/javascript">
let map, infoWindow;
function initMap() {
  const directionsService = new google.maps.DirectionsService();
  const directionsRenderer = new google.maps.DirectionsRenderer();
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 6,
    center: { lat: 41.85, lng: -87.65 },
  });
  directionsRenderer.setMap(map);
  document.getElementById("submit").addEventListener("click", () => {
    calculateAndDisplayRoute(directionsService, directionsRenderer);
  });
  
  infoWindow = new google.maps.InfoWindow();

  const locationButton = document.createElement("button");

  locationButton.textContent = "Pan to Current Location";
  locationButton.classList.add("custom-map-control-button");
  map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
  locationButton.addEventListener("click", () => {
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };

          infoWindow.setPosition(pos);
          infoWindow.setContent("Location found.");
          infoWindow.open(map);
          map.setCenter(pos);
        },
        () => {
          handleLocationError(true, infoWindow, map.getCenter());
        }
      );
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }
  });
}

function calculateAndDisplayRoute(directionsService, directionsRenderer) {
  const waypts = [];
  const checkboxArray = document.getElementById("waypoints");

  for (let i = 0; i < checkboxArray.length; i++) {
    if (checkboxArray.options[i].selected) {
      waypts.push({
        location: checkboxArray[i].value,
        stopover: true,
      });
    }
  }
  directionsService
    .route({
      origin: document.getElementById("start").value,
      destination: document.getElementById("end").value,
      waypoints: waypts,
      optimizeWaypoints: true,
      travelMode: google.maps.TravelMode.DRIVING,
    })
    .then((response) => {
      directionsRenderer.setDirections(response);
      const route = response.routes[0];
      const summaryPanel = document.getElementById("directions-panel");
      summaryPanel.innerHTML = "";

      // For each route, display summary information.
      for (let i = 0; i < route.legs.length; i++) {
        const routeSegment = i + 1;
        summaryPanel.innerHTML +=
          "<b>Route Segment: " + routeSegment + "</b><br>";
        summaryPanel.innerHTML += route.legs[i].start_address + " to ";
        summaryPanel.innerHTML += route.legs[i].end_address + "<br>";
        summaryPanel.innerHTML += route.legs[i].distance.text + "<br><br>";
      }
    })
    .catch((e) => window.alert("Directions request failed due to " + status));
}
</script>
        <?php
            $this->load->view('admin/include/footer-content');
        ?>

        <!-- Control Sidebar -->
        
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
<!-- ./wrapper -->
<?php
    $this->load->view('admin/include/footer');
?>