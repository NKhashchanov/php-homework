<?php
$json = file_get_contents("http://api.openweathermap.org/data/2.5/weather?id=524901&appid=75a581da7fb00c30a963edf8a5c311c3&mode=json&units=metric");
$jsonData = json_decode($json, true);

//Дата
$date = date('d.m.Y', $jsonData['dt']);

//Температура
$temp = $jsonData['main']['temp'];

//Давление
$pressure = floor($jsonData['main']['pressure'] * 0.750063755419211); //гектопаскали переводим в мм рт столба

//Влажность
$humidity = $jsonData['main']['humidity'];

//Облачность
if ($jsonData['clouds']['all'] <= 10){
    $jsonData['clouds']['all'] = 'ясное';
    $cloudsImg = '<img src="img/clouds1.png">';
} elseif ($jsonData['clouds']['all'] > 10 && $jsonData['clouds']['all'] <= 30){
    $jsonData['clouds']['all'] = 'с переменной облачностью';
    $cloudsImg = '<img src="img/clouds2.png">';
} elseif ($jsonData['clouds']['all'] > 30 && $jsonData['clouds']['all'] <= 60){
    $jsonData['clouds']['all'] = 'облачное, с прояснениями';
    $cloudsImg = '<img src="img/clouds3.png">';
} else {
    $jsonData['clouds']['all'] = 'затянуто облаками';
    $cloudsImg = '<img src="img/clouds4.png">';
}
$clouds = $jsonData['clouds']['all'];

//Скорость ветра
$windSpeed = $jsonData['wind']['speed'];

//Направление ветра
if ($jsonData['wind']['deg'] >= 225 && $jsonData['wind']['deg'] < 315){
    $jsonData['wind']['deg'] = 'западный';
    $windImg = '<img src="img/wind1.png">';
} elseif ($jsonData['wind']['deg'] >= 45 && $jsonData['wind']['deg'] < 135){
    $jsonData['wind']['deg'] = 'восточный';
    $windImg = '<img src="img/wind2.png">';
} elseif ($jsonData['wind']['deg'] >= 135 && $jsonData['wind']['deg'] < 225){
    $jsonData['wind']['deg'] = 'южный';
    $windImg = '<img src="img/wind3.png">';
} else {
    $jsonData['wind']['deg'] = 'северный';
    $windImg = '<img src="img/wind4.png">';
}
$windDeg = $jsonData['wind']['deg'];

//Вывод
echo <<<HTML
<table style="border: 1px solid #355f7c; border-collapse: collapse; text-align: center;">
    <tr style="border: 1px solid #355f7c">
        <td colspan="2"><h2>Сегодня {$date}</h2></td>
    </tr>
    <tr style="border: 1px solid #355f7c">
        <td style="border: 1px solid #355f7c"><img src="img/temp.png"></td>
        <td>Температура воздуха<br>{$temp} &#176;С</td>
    </tr>
    <tr style="border: 1px solid #355f7c">
        <td style="border: 1px solid #355f7c"><img src="img/pressure.png"></td>
        <td>Атмосферное давление<br>{$pressure} мм рт. столба</td>
    </tr>
    <tr style="border: 1px solid #355f7c">
        <td style="border: 1px solid #355f7c"><img src="img/humidity.png"></td>
        <td>Влажность<br>{$humidity} %</td>
    </tr>
    <tr style="border: 1px solid #355f7c">
        <td style="border: 1px solid #355f7c">{$cloudsImg}</td>
        <td>Небо<br>{$clouds}</td>
    </tr>
    <tr style="border: 1px solid #355f7c">
        <td style="border: 1px solid #355f7c">{$windImg}</td>
        <td>Ветер {$windDeg}<br>скорость ветра {$windSpeed} м/с</td>
    </tr>
</table>
HTML;
?>
