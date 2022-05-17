google.maps.event.addDomListener(window, "load", function () {
  var places = new google.maps.places.Autocomplete(
    document.getElementById("autocomplete2")
  );
  google.maps.event.addListener(places, "place_changed", function () {
    var place = places.getPlace();
    // console.log(place);
    var address = place.formatted_address;
    var zip = place.formatted_address.postal_code;

    $("#zip_to").val("");
    $("#address2_to").val("");
    $("#country_to").val("");
    $("#state_to").val("");
    $("#city_to").val("");

    for (var i = 0; i < place.address_components.length; i++) {
      for (var j = 0; j < place.address_components[i].types.length; j++) {
        if (place.address_components[i].types[j] == "postal_code") {
          document.getElementById("zip_to").value =
            place.address_components[i].long_name;
        }

        if (place.address_components[i].types[j] == "sublocality_level_2") {
          document.getElementById("address2_to").value =
            place.address_components[i].long_name;
        }

        if (place.address_components[i].types[j] == "country") {
          var country2_drop = document.getElementById("country_to");
          for (var k = 0; k < country2_drop.options.length; k++) {
            if (
              country2_drop.options[k].text ===
              place.address_components[i].long_name
            ) {
              country2_drop.selectedIndex = k;
              $("#country_to").trigger("change");
              break;
            }
          }
        }

        if (
          place.address_components[i].types[j] == "administrative_area_level_1"
        ) {
          document.getElementById("state_to_google_val").value =
            place.address_components[i].long_name;
        }

        if (
          place.address_components[i].types[j] == "administrative_area_level_2"
        ) {
          document.getElementById("city_to_google_val").value =
            place.address_components[i].long_name;
        }
      }
    }

    let lat = place.geometry.location.lat();
    $("#lat_to").val(lat);

    let lng = place.geometry.location.lng();
    $("#lng_to").val(lng);

    // console.log(place.geometry.location.lat());
  });
});

// To Address
google.maps.event.addDomListener(window, "load", function () {
  var places = new google.maps.places.Autocomplete(
    document.getElementById("autocomplete")
  );
  google.maps.event.addListener(places, "place_changed", function () {
    var place = places.getPlace();
    // console.log(place);
    var address = place.formatted_address;
    var zip = place.formatted_address.postal_code;

    $("#zip").val("");
    $("#address2").val("");
    $("#country").val("");
    $("#state").val("");
    $("#city").val("");

    for (var i = 0; i < place.address_components.length; i++) {
      for (var j = 0; j < place.address_components[i].types.length; j++) {
        if (place.address_components[i].types[j] == "postal_code") {
          document.getElementById("zip").value =
            place.address_components[i].long_name;
          console.log(place.address_components[i].long_name);
        }

        if (place.address_components[i].types[j] == "sublocality_level_2") {
          document.getElementById("address2").value =
            place.address_components[i].long_name;
          console.log(place.address_components[i].long_name);
        }

        if (place.address_components[i].types[j] == "country") {
          var country2_drop = document.getElementById("country");
          for (var k = 0; k < country2_drop.options.length; k++) {
            if (
              country2_drop.options[k].text ===
              place.address_components[i].long_name
            ) {
              country2_drop.selectedIndex = k;
              $("#country").trigger("change");
              break;
            }
          }
        }

        if (
          place.address_components[i].types[j] == "administrative_area_level_1"
        ) {
          document.getElementById("state_google_val").value =
            place.address_components[i].long_name;
        }

        if (
          place.address_components[i].types[j] == "administrative_area_level_2"
        ) {
          document.getElementById("city_google_val").value =
            place.address_components[i].long_name;
        }
      }
    }

    let lat = place.geometry.location.lat();
    $("#lat_from").val(lat);

    let lng = place.geometry.location.lng();
    $("#lng_from").val(lng);
  });
});

// Registration Form
