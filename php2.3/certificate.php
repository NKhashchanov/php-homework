<?php
header("Content-Type: image/png");
$im = imagecreate(400, 200);
$backgroundColor = imagecolorallocate($im, 200, 200, 200);
$textColor = imagecolorallocate($im, 233, 14, 91);
imagestring($im, 50, 5, 5, 'Certificate owner: ' . $_GET['username'], $textColor);
imagepng($im);
imagedestroy($im);

