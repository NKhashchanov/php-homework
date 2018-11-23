<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>

ymaps.ready(function () {

    var coord = window.location.href;
    coord = coord.substring(coord.indexOf('?'));
    coord = coord.replace('?', '');
    coord = coord.replace('%20', ' ');
    coord = coord.split(' ');
    [coord[0], coord[1]] = [coord[1], coord[0]];
    console.log(coord);

    if (coord[0] === undefined) {
        coord[0] = 55.755814;
        coord[1] = 37.617635
    }

        var myMap = new ymaps.Map('map', {
                center: coord,
                zoom: 14
            }, {
                searchControlProvider: 'yandex#search'
            }),

            // Создаём макет содержимого.
            MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
                '<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
            ),

            myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
                hintContent: 'Собственный значок метки',
                balloonContent: 'Это красивая метка'
            }),

            myPlacemarkWithContent = new ymaps.Placemark(coord, {
                hintContent: 'Собственный значок метки с контентом',
                balloonContent: 'адрес',
                iconContent: '12'
            });

        myMap.geoObjects
            .add(myPlacemark)
            .add(myPlacemarkWithContent);
    });
</script>

<style>
    #map {
        width: 640px; height: 480px; padding: 0; margin: 0;
    }
</style>

<div style="display: flex;">
<div style="width: 50%">
<?php
if (!empty($_POST['address'])) :
    $json = file_get_contents('https://geocode-maps.yandex.ru/1.x/?format=json&geocode='. $_POST['address'] .'');
    $jsonData = json_decode($json, true);
    $coordinates = $jsonData['response']['GeoObjectCollection']['featureMember'];
?>
    <?php foreach ($coordinates as $value) : ?>
        <a href="?<?=$value['GeoObject']['Point']['pos']?>"
        <br>Найденный адрес: <?=$value["GeoObject"]["metaDataProperty"]["GeocoderMetaData"]["AddressDetails"]["Country"]["AddressLine"]?>
        <br>Координаты: <?=$value['GeoObject']['Point']['pos']?><br>
        </a><br>
    <?php endforeach ?>
<?php endif ?>

</div>
<div id="map"  style="width: 50%"></div>
</div>
<h2>Введите адрес, по которому Вы хотите узнать координаты</h2>
<form method = 'POST'>
    <input type = 'text' name = 'address' placeholder = 'Введите адрес'>
    <input type = 'submit' value = 'Отправить'>
</form>

