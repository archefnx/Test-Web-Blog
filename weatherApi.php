$apiKey ='e25f74c76d7bb4c2b57830ab9b129c16';
$city = "Kostanay";
$url = "http://api.openweathermap.org/data/2.5/weather?q=" . $city . "&lang=ru&units=metric&appid=" . $apiKey;
$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);

$weatherData = json_decode(curl_exec($ch));
curl_close($ch);
