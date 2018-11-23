<head>
<style>
    .contacts {
        border: solid 1px;
        border-collapse: collapse;
        border-top: none;
    }
    .contactsTop {
        border: solid 1px;
        border-collapse: collapse;
    }
    .firstName {
        width: 100px;
        border: solid 1px;
        border-top: none;
    }
    .lastName {
        width: 100px;
        border: solid 1px;
        border-top: none;
    }
    .address {
        width: 500px;
        border: solid 1px;
        border-top: none;
    }
    .phoneNumber {
        width: 200px;
        border: solid 1px;
        border-top: none;
    }
</style>
</head>
<?php
$json = file_get_contents(__DIR__ . '/data.json');
$jsonData = json_decode($json, true);

echo <<<HTML
<table class = "contactsTop">
    <tr style = "font-weight: bold;">
        <td class = "firstName">Имя</td>
        <td class = "lastName">Фамилия</td>
        <td class = "address">Адрес</td>
        <td class = "phoneNumber">Телефон</td>
    </tr>
</table>
HTML;

foreach ($jsonData as $value) {
    echo <<<HTML
        <table class = "contacts">
            <tr>
                <td class = "firstName">{$value['firstName']}</td>
                <td class = "lastName">{$value['lastName']}</td>
                <td class = "address">{$value['address']}</td>
                <td class = "phoneNumber">{$value['phoneNumber']}</td>
            </tr>
        </table>
HTML;
}
