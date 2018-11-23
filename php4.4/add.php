<?php
require_once 'application.php';
?>
<form method="POST">
    <input required type = 'text' name = 'field' value="<?php fieldText() ?>">
    <select name = 'type' required >
        <option value="<?php typeText() ?>"><?php typeText() ?></option>
        <option value="int">int</option>
        <option value="text">text</option>
        <option value="date">date</option>
    </select>
    <input type="submit" name="edit" value="Изменить"><input type="submit" name="add" value="Добавить">
</form>
