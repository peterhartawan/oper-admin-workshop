$(document).ready(function() {
    initMap();
});

function initMap() {
    // Initialize Maps For Create
    default_latlng = new google.maps.LatLng(-6.161287494589915, 106.762708119932597)
    default_maps_conf = {
        zoom:17,
        center: default_latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    // Create modal
    create_map_poi = new google.maps.Map(document.getElementById("create-maps"), default_maps_conf);

    create_marker_poi = new google.maps.Marker({
        position: default_latlng,
        draggable: true,
        map: create_map_poi
    });

    new google.maps.event.addListener(create_map_poi, "click", function(event) {
        $('#create-latitude').val(event.latLng.lat().toFixed(15));
        $('#create-latitude').valid();
        $('#create-longitude').val(event.latLng.lng().toFixed(15));
        $('#create-longitude').valid();

        create_marker_poi.setPosition(event.latLng);
    });

    // Update modal
    update_map_poi = new google.maps.Map(document.getElementById("update-maps"), default_maps_conf);

    update_marker_poi = new google.maps.Marker({
        position: default_latlng,
        draggable: true,
        map: update_map_poi
    });

    new google.maps.event.addListener(update_marker_poi, "dragend", function(event) {
        $('#update-latitude').val(event.latLng.lat().toFixed(15));
        $('#update-latitude').valid();
        $('#update-longitude').val(event.latLng.lng().toFixed(15));
        $('#update-longitude').valid();

        update_map_poi.setPosition(event.latLng);
    });

    // Search
    // const input = document.getElementById("create-address");
    // console.log(input);
    // const searchBox = google.maps.places.SearchBox(input);
    // console.log(searchBox);
    //
    // try {
    //     searchBox.addListener('places_changed', function(place) {
    //         console.log(place)
    //         marker_poi.setPosition(place.geometry.location);
    //     });
    // } catch (e) {
    //     console.log(e);
    // }
}
