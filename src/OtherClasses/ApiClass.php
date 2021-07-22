<?php


namespace Blog\OtherClasses;


class ApiClass
{
    private $weatherData;

    public function getWeatherData(string $city)
    {
        $apiKey ='e25f74c76d7bb4c2b57830ab9b129c16';
        $town = "$city";
        $url = "http://api.openweathermap.org/data/2.5/weather?q=" . $town . "&lang=ru&units=metric&appid=" . $apiKey;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);

        $this->weatherData = json_decode(curl_exec($ch));
        return $this->weatherData;
    }
}