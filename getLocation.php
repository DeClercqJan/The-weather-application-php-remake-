<?php
// vraag: kan ik kan ik de jquery niet naar zichzelf ipv van naar getlocaiton doen verwijzen?

//if latitude and longitude are submitted
if(!empty($_POST['latitude']) && !empty($_POST['longitude'])){
    //send request and receive json data by latitude and longitude
    // WERKT NIET, HEB JE KEY VOOR NODIG
    // $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($_POST['latitude']).','.trim($_POST['longitude']).'&sensor=false';
   // EENS PROBEREN MET URL DIE IK OORSPRONKGELIJK GEBRUIKTE
    $url = 'https://api.openweathermap.org/data/2.5/forecast?lat='.trim($_POST['latitude']).'&lon='.trim($_POST['longitude']).'&appid=fac9676aa8de6252977e1a8672e861e2';
    $json = @file_get_contents($url);
    $data = json_decode($json);
    // $status = $data->status;
    $status = $data->cod;

    //if request status is successful
    //if($status == "OK"){
    //    //get address from json data
    //    $location = $data->results[0]->formatted_address;
    //}else{
    //    $location =  "test status niet ok";
    //    // location =  '';
    //}
    
    if($status == "200"){
           //get address from json data
           // $location = $data->results[0]->formatted_address;
           $location = "status is 200";
        }else{
            $location =  "test status niet ok";
           // location =  '';
        }

    //return address to ajax 
    //echo $location;

    print_r($location);
}
