<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The weather tomorrow today, with Nao and Jan</title>
    <link rel="stylesheet" href="/styles/reset.css" class="style">
    <link rel="stylesheet" href="/styles/style.css" class="style">
    <!-- probably need to add more to head (description, author ...) + restructure (location script?)-->
</head>

<body>
    <header>
        <img class="header_pics" src="images/nao.jpg" id="test_icon">
        <h1>The weather tomorrow today<br> with Nao and Jan</h1>
        <img class="header_pics" src="images/jan.jpg">
    </header>
    <main>
        <article>
            <section class="containing_section">
                <section class="top_section">
                    <h2>Get a 5-day foreceast for your town </h2>
                    <p>Accept the geolocation geolocation service prompted in your browsers to get the forecast based on
                        your actual location. Alternatively, you can manually enter the city</p>
                </section>
                <section class="middle_section">
                    <form action="index.php" method="post" id="form_1">
                        <fieldset>
                            <legend id="table_legend">Manually enter the town you want the forecast for</legend>
                                <div><label for="input_field_city">Your city</label>
                                    <input type="text" name="city" id="input_field_city"
                                        placeholder="enter your city here" required /></br>
                                </div>
                                <div><label for="input_field_country">Your country (optional)</label>
                                         <input type="text" name="country" id="input_field_country"
                                         maxlength="2" placeholder="enter your country code (2characters)"
                                         /></br>
                                    <!-- <input type="text" name="country" id="input_field_country"
                                         value="enter your country code (2characters) here" maxlength="2" 
                                         /></br> -->
                                </div>
                                <div>
                                    <!-- <input type="submit" value="submit" id="submit" class="submit"> -->
                                    <!-- <button type="button" id="run">Get forecast</button> -->
                                <!-- eens proberen met input ipv button om te zien of PHP hier beter op reageert -->
                            <input type="submit" id="run" value="get the forecast">
                            </div>
                        </fieldset>
                    </form>
                </section>
                <section class="bottom_section">
                    <table>
                    <?php 
                                        if (isset($_POST["country"])) {
                                            // geeft probleem met value-tekst van inputfield. value dus verwijderd en expliciet voor de attriubute placeholder gekozen
                                            $country = $_POST["country"];
                    
                                        }
                                        else {
                                             $country = "";
                                        }
                    if (isset($_POST["city"])) {
                        // geeft probleem met value-tekst van inputfield. value dus verwijderd en expliciet voor de attriubute placeholder gekozen
                    $city = $_POST["city"];
                    // werkende link in browser: https://api.openweathermap.org/data/2.5/forecast/?q=bruges,be&appid=fac9676aa8de6252977e1a8672e861e2"
// is het GET dat ik ndoig heb?
// EDIT: iemand die zegt dat GET beter is voor privacy(komt niet in URL terecht)
// oef, iets werkends gevonden, nu nog omvormen van bestand
// $data_json = file_get_contents('https://api.openweathermap.org/data/2.5/forecast/?q=bruges,be&appid=fac9676aa8de6252977e1a8672e861e2');
$comma_country = "";
if (!empty($county)) {
    $comma_country = ",$country";
}
else {
    $comma_country = "";
}

$url = "https://api.openweathermap.org/data/2.5/forecast/?q=$city" . "$comma_country" . "&appid=fac9676aa8de6252977e1a8672e861e2";
// var_dump($url);
$data_json = file_get_contents($url);
// echo $data_json;
$data = json_decode($data_json);
$test = $data->message;
$test;
// $test_2 = $data->list;
// echo $test_2;
// var_dump($test_2);
// print_r($test_2);
// $test_3 = $test_2[0]->dt;
//echo $test_3;
$data_list = $data->list;
// echo $data_list;
// print_r($data_list);
$data_day_1 = $data_list[0];
// echo $data_day_1;
// print_r($data_day_1);
$data_time = $data_day_1->dt_txt;
// print_r($data_sys);
// echo $data_date;  
// NU IN HET KORT 
//echo $data->list[0]->dt_txt; 
// nu bouwen om goede structuur te hebben
$data_list = $data->list;
// DIT HIERONDER PRINT TEVEEL; ALLE UREN
/* foreach ($data_time as $time) {
    print_r($time->dt_txt);
    // echo $days[i]->dt_txt;
}
*/
// ik wil enkel die waarden behouden die over de middag gaan
// Note our use of ===.  Simply == would not work as expected
// because the position of 'a' was the 0th (first) character.
$data_noon = array();
$data_noon_day = array();
$data_noon_day_only_pair_array = array();
$data_selected = array();
foreach ($data_list as $element) {
    $data_time = $element->dt_txt;
    // print_r($data_time);
    $pos = strpos($data_time, "12:00");
     if ($pos === false) {
      //  echo "The string 12:00 was not found in the string '$time'";
    } else {
     //   echo "The string 12:00 was found in the string '$time'";
     //   echo " and exists at position $pos";
     // DEZE BEVAT HET GELIJK VAN ALLES EEN AANTAL KEER
     // print_r($data_time); 
     array_push($data_noon, $data_time);
     // foreach ($data_noon as $key => $value) {
        // echo $value;
        // $data_noon_day_only = explode(" ", $value); 
// print_r($data_noon_day_only);
    //}
     array_push($data_selected, $element);
    }
}

// foreach ($data_noon as $key => $value) {
//    $data_noon_day_only_pair = explode(" ", $value); 
//    $data_noon_day_only_single = $data_noon_day_only_pair[0];
//    array_push($data_noon_day_only_pair_array, $data_noon_day_only_single);
//}
 // print_r($data_noon);
// print_r ($data_noon_day_only_pair);
// print_r ($data_noon_day_only_single);
// WERKT OM VERSCHILLENDE DATA AFZONDERLIJK TE PAKKEN, MAAR VOOR HIERONDER HTML AAN TE PASSEN, WIL IK HET IN 1 KEER KUNNEN; DAT IK 1 ARRAY OVERLOOP EN NIET MEERDERE MOET MENGEN
// print_r ($data_noon_day_only_pair_array);
// print_r($data_selected);



                }
                else {
                    $city = "?";
                }
?>
                        <caption>Forecast for your <?php echo $city . "," . $country?> for the next 5 days at noon</caption>
                        <thead>
                            <tr>
                                <th id="town">Town</th>
                                <th>Weekday</th>
                                <th>Forecast</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        
                         $i = 1; 
                            foreach($data_selected as $element) {
                               
                                $day_hour_separated= explode(" ", $element->dt_txt);
                                $element_day = $day_hour_separated[0];
                                // moet omvormen, want ander systeem dan dat wij gebruiken
                                $element_day_reorded = date("d-m-Y", strtotime($element_day));
                                // dit geeft dag die ermee overeenkomt
                                // $element_weekday = date("l", strtotime($element_day));
                                $element_weekday = date("l", strtotime($element_day_reorded));
                                ?>
                                <tr id="table_row_<?php echo $i ?>">
                                <td>
                                <?php // echo $element->dt_txt; 
                                        echo $element_day_reorded; 
                                        ?> 
                                </td>
                                <td>
                                <?php // echo $element->dt_txt; 
                                        // echo $element_day_reorded;
                                        echo $element_weekday;
                                        ?> 
                                </td>
                                </td>
                                <td>
                                <?php // echo $element->dt_txt; 
                                        echo $element->weather[0]->description; 
                                        ?> 
                                </td>
                                </tr>
                                <?php
                                $i ++;
                            } 
                        ?>
                            <!-- <tr id="table_row_1">
                                <td>date x</td>
                                <td>?</td>
                                <td>?</td>
                            </tr>
                            <tr id="table_row_2">
                                <td>date x</td>
                                <td>?</td>
                                <td>?</td>
                            </tr>
                            <tr id="table_row_3">
                                <td>date x</td>
                                <td>?</td>
                                <td>?</td>
                            </tr>
                            <tr id="table_row_4">
                                <td>date x</td>
                                <td>?</td>
                                <td>?</td>
                            </tr>
                            <tr id="table_row_5">
                                <td>date x</td>
                                <td>?</td>
                                <td>?</td>
                            </tr>
                            -->
                        </tbody>
                    </table>
                </section>
            </section>
        </article>
    </main>
    <footer>
        <p>&#169 2019</p>
        <adress>
            <span>You can contact Naoyuki Arakawa via </span><a href="mailto:arakawa2050@gmail.com">arakawa2050@gmail.com</a><br>
            <span>You can contact Jan De Clercq via </span><a href="mailto:declercqjan@gmail.com">declercqjan@gmail.com</a><br>
        </adress>
    </footer>
    <script type="text/javascript" src="/scripts/javascript.js"></script>
</body>

</html>