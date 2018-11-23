<?php
header("Content-Type: image/png");
$im = imagecreate(400, 200);
$background_color = imagecolorallocate($im, 200, 200, 200);
$text_color = imagecolorallocate($im, 233, 14, 91);
imagestring($im, 50, 5, 5, 'Certificate owner: ' . $_GET['username'], $text_color);
imagepng($im);
imagedestroy($im);

