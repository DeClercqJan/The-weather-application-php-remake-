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
                                            $country = "?";
                                        }
                    if (isset($_POST["city"])) {
                        // geeft probleem met value-tekst van inputfield. value dus verwijderd en expliciet voor de attriubute placeholder gekozen
                    $city = $_POST["city"];
                    // werkende link in browser: https://api.openweathermap.org/data/2.5/forecast/?q=bruges,be&appid=fac9676aa8de6252977e1a8672e861e2"
// is het GET dat ik ndoig heb?
// EDIT: iemand die zegt dat GET beter is voor privacy(komt niet in URL terecht)
// oef, iets werkends gevonden, nu nog omvormen van bestand
$homepage = file_get_contents('https://api.openweathermap.org/data/2.5/forecast/?q=bruges,be&appid=fac9676aa8de6252977e1a8672e861e2');
echo $homepage;
                }
                else {
                    $city = "?";
                }
?>
                        <caption>Forecast for your <?php echo "$city, $country"?> for the next 5 days at noon</caption>
                        <thead>
                            <tr>
                                <th id="town">Town</th>
                                <th>Weekday</th>
                                <th>Forecast</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="table_row_1">
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