<?php
require_once __DIR__ . '/functions.php';
if (!isAdmin()) {
    http_response_code(403);
    echo 'Вам доступ запрещен!';
    die;
}
if ($_FILES == null) {
} else {
    $tmpName = $_FILES["testFile"]["tmp_name"];
    $type = $_FILES["testFile"]["type"];
    $normalName = $_FILES["testFile"]["name"];
    if (is_uploaded_file($tmpName) && $type === 'application/octet-stream') {
        move_uploaded_file($tmpName, __DIR__ . '/tests/' . $normalName);
        header('Location: http://localhost/list.php');
    } else {
        echo("Ошибка загрузки файла");
    }
}
    echo '
    <form enctype="multipart/form-data" action="" method="POST">
	<input type="file" name="testFile" style="margin-bottom: 20px"><br>
	<input type="submit" value="Отправить"><br>
    </form>
';

?>