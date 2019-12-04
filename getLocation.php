<?php
 session_start();
// vraag: kan ik kan ik de jquery niet naar zichzelf ipv van naar getlocaiton doen verwijzen?

//if latitude and longitude are submitted
if(!empty($_POST['latitude']) && !empty($_POST['longitude'])){
    //send request and receive json data by latitude and longitude
    // WERKT NIET, HEB JE KEY VOOR NODIG
    // $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($_POST['latitude']).','.trim($_POST['longitude']).'&sensor=false';
   // EENS PROBEREN MET URL DIE IK OORSPRONKGELIJK GEBRUIKTE
    $url_2 = 'https://api.openweathermap.org/data/2.5/forecast?lat='.trim($_POST['latitude']).'&lon='.trim($_POST['longitude']).'&appid=fac9676aa8de6252977e1a8672e861e2';
    $json_2 = @file_get_contents($url_2);
    $data_2 = json_decode($json_2);
    // $status = $data->status;
    $status_2 = $data_2->cod;

    //if request status is successful
    //if($status == "OK"){
    //    //get address from json data
    //    $location = $data->results[0]->formatted_address;
    //}else{
    //    $location =  "test status niet ok";
    //    // location =  '';
    //}
    
    if($status_2 == "200"){
           //get address from json data
           // $location = $data->results[0]->formatted_address;
           $location = "status is 200";
           $data_list = $data_2->list;
           $data_list_json = json_encode($data_list);
           // var_dump($data_list);

        }else{
            $location =  "test status niet ok";
           // location =  '';
        }

    //return address to ajax 
    //echo $location;

    print_r($data_list_json);
    // echo $data_list;
}
