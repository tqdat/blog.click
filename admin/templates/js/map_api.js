function set_geoEncode() {
    var geocoder = new google.maps.Geocoder();
    var address = $("#address").val();

   if (geocoder) {
      geocoder.geocode({ 'address': address }, function (results, status) {
         if (status == google.maps.GeocoderStatus.OK) {
            searchLocationsNear(results[0].geometry.location);
         }
         else {
            console.log("Geocoding failed: " + status);
         }
      });
   } 
}
function find_local(address){
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'address': address }, function (results, status) {
         if (status == google.maps.GeocoderStatus.OK) {
            //searchLocationsNear(results[0].geometry.location);
            location1 = results[0].geometry.location;
            $("#lat").val(location1.lat());
            $("#lng").val(location1.lng());
            //addlocal(location1.lat(), location1.lng(), title,content,map_div);
            console.log("Geocoding failed: " + location1.lat()+" , "+location1.lng());
         }
         else {
            //console.log("Geocoding failed: " + results[0].geometry.location.lat()+", "+results[0].geometry.location.lng());
         }
      });
}

function get_geoEncode(address, title,content,map_div) {
    var geocoder = new google.maps.Geocoder();
    //var address = $("#address").val();

   //if (geocoder) {
      geocoder.geocode({ 'address': address }, function (results, status) {
         if (status == google.maps.GeocoderStatus.OK) {
            //searchLocationsNear(results[0].geometry.location);
            location1 = results[0].geometry.location;
            addlocal(location1.lat(), location1.lng(), title,content,map_div);
            console.log("Geocoding failed: " + location1.lat()+" , "+location1.lng());
         }
         else {
            //console.log("Geocoding failed: " + results[0].geometry.location.lat()+", "+results[0].geometry.location.lng());
         }
      });
   //} 
}
function addlocal(la,lo,title,content,map_div){
    var latlng = new google.maps.LatLng(la,lo);
    var options = {  
        zoom: 17, 
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };  
    
    var map = new google.maps.Map(document.getElementById(map_div), options);  
    var image = new google.maps.MarkerImage(base_url+'templates/images/logo_map.png',
        new google.maps.Size(40, 42),
        new google.maps.Point(0,0),
        new google.maps.Point(35, 40)
    );
    
    // Add Marker
    var marker1 = new google.maps.Marker({
        position: new google.maps.LatLng(la,lo), 
        map: map,        
        icon: image 
    });    
    
    google.maps.event.addListener(marker1, 'click', function() {  
        infowindow1.open(map, marker1);  
    });
        
    var infowindow1 = new google.maps.InfoWindow({  
        content:  createInfo(title,content)
    }); 
    
    function createInfo(title, content) {
        return '<div class="infowindow">'+content+'</div>';
    }
}