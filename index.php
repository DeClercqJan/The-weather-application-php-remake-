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
                                <input type="text" name="city" id="input_field_city" placeholder="enter your city here" required /></br>
                            </div>
                            <div><label for="input_field_country">Your country (optional)</label>
                                <input type="text" name="country" id="input_field_country" maxlength="2" placeholder="enter your country code (2characters)" /></br>
                            </div>
                            <div>
                                <!-- eens proberen met input ipv button om te zien of PHP hier beter op reageert -->
                                <input type="submit" id="run" value="get the forecast">
                            </div>
                        </fieldset>
                    </form>
                </section>
                <section class="bottom_section">
                    <table>
                        <?php
                        // EDIT: iemand die zegt dat GET beter is voor privacy(komt niet in URL terecht)
                        if (isset($_POST["country"])) {
                            // geeft probleem met value-tekst van inputfield. value dus verwijderd en expliciet voor de attriubute placeholder gekozen
                            $country = $_POST["country"];
                        } else {
                            $country = "";
                        }
                        // opdat request naar api goed verloopt
                        $country_input = "";
                        if (!empty($county)) {
                            $country_input = ",$country";
                        } else {
                            $country_input = "";
                        }
                        if (isset($_POST["city"])) {
                            // geeft probleem met value-tekst van inputfield. value dus verwijderd en expliciet voor de attriubute placeholder gekozen
                            $city = $_POST["city"];
                            $url = "https://api.openweathermap.org/data/2.5/forecast/?q=$city" . "$country_input" . "&appid=fac9676aa8de6252977e1a8672e861e2";
                            $data_json = file_get_contents($url);
                            $data = json_decode($data_json);
                            $data_list = $data->list;
                            // ik wil enkel die waarden behouden die over de middag gaan
                            $data_noon = array();
                            $data_noon_day = array();
                            $data_noon_day_only_pair_array = array();
                            $data_selected = array();
                            foreach ($data_list as $element) {
                                $data_time = $element->dt_txt;
                                $element_noon = strpos($data_time, "12:00");
                                if ($element_noon === false) {
                                    //  echo "The string 12:00 was not found in the string '$time'";
                                } else {
                                    array_push($data_noon, $data_time);
                                    array_push($data_selected, $element);
                                }
                            }
                        } else {
                            $city = "?";
                        }
                        ?>
                        <!-- probleem: ik krijg $country of $country_input niet in het onderstaande-->
                        <caption>Forecast for <?php echo $city;?> 
                        <?php if(!empty($country)){echo "($country)";} ?>
                         for the next 5 days at noon</caption>
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
                            foreach ($data_selected as $element) {

                                $day_hour_separated = explode(" ", $element->dt_txt);
                                $element_day = $day_hour_separated[0];
                                // moet omvormen, want ander systeem dan dat wij gebruiken
                                $element_day_reorded = date("d-m-Y", strtotime($element_day));
                                // dit geeft dag die ermee overeenkomt
                                $element_weekday = date("l", strtotime($element_day_reorded));
                                ?>
                                <tr id="table_row_<?php echo $i ?>">
                                    <td>
                                        <?php
                                            echo $element_day_reorded;
                                            ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $element_weekday;
                                            ?>
                                    </td>
                                    </td>
                                    <td>
                                        <?php
                                            echo $element->weather[0]->description;
                                            ?>
                                    </td>
                                </tr>
                            <?php
                                $i++;
                            }
                            ?>
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