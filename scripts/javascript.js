function isFloat(x) { return !!(x % 1); }

async function fetch_coordinates() {
    // api.openweathermap.org/data/2.5/forecast?lat={lat}&lon={lon} 
    await fetch (`https://api.openweathermap.org/data/2.5/forecast?lat=${my_position_latitude_to_fixed}_&lon=${my_position_latitude_float}&appid=fac9676aa8de6252977e1a8672e861e2`)
    .then(ste => ste.json())
    .then(result => {
        console.log(result)
        // console.log(result.city)
        // console.log(result.list)
        // console.log(result.list.weather);
        /*
        result.list.forEach(element => {
            // console.log(element);
            console.log(element.weather)
            console.log(element.weather[0]);
            console.log(element.weather[0].main);
            console.log(element.weather[0].description);
        });

    })
    */
})
}

function showPosition() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
        // getting "is not a float"-error from API
      console.log(position);
      my_position_longitude = position.coords.longitude;
      //console.log(my_position_longitude);
      my_position_longitude_string = my_position_longitude.toString();
      my_position_longitude_float = parseFloat(my_position_longitude_string);
      console.log(typeof my_position_longitude_float);
      console.log(isFloat(my_position_longitude_float))
      console.log(my_position_longitude_float);
      my_position_latitude = position.coords.latitude;
      my_position_latitude_string = my_position_latitude.toString();
      my_position_latitude_float = parseFloat(my_position_latitude_string);
      console.log(typeof my_position_latitude_float);
      console.log(isFloat(my_position_latitude_float))
      console.log(my_position_latitude_float);
      my_position_latitude_to_fixed = my_position_latitude_float.toFixed(6);
      console.log(my_position_latitude_to_fixed);
      fetch_coordinates();
    });
  } else {
    alert("Sorry, your browser does not support HTML5 geolocation.");
  }
}

// als ik aan mijn php-oefening begin, krijg ik foutmelding A Geolocation request can only be fulfilled in a secure context. Dus afgezet
// window.onload = showPosition();

async function fetch_input() {
  // standaarddata voor moskou await fetch("http://api.openweathermap.org/data/2.5/forecast?id=524901&APPID=fac9676aa8de6252977e1a8672e861e2")
  // example await fetch("https://samples.openweathermap.org/data/2.5/weather?q=London,uk&appid=b6907d289e10d714a6e88b30761fae22")
 //  gent await fetch("https://api.openweathermap.org/data/2.5/weather?q=Gent,be&appid=fac9676aa8de6252977e1a8672e861e2")
 await fetch("https://api.openweathermap.org/data/2.5/forecast?q=Gent,be&appid=fac9676aa8de6252977e1a8672e861e2")
 .then(ste => ste.json())
  .then(result => {
      console.log(result)
      // console.log(result.city)
      // console.log(result.list)
      // console.log(result.list.weather);
      result.list.forEach(element => {
          // console.log(element);
          console.log(element.weather)
          console.log(element.weather[0]);
          console.log(element.weather[0].main);
          console.log(element.weather[0].description);
      });

  })
}

