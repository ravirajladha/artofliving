<?php
header('Content-Type: image/png');
header('Content-Disposition: attachment; filename="aolqr.png"');
$image = file_get_contents('https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.$data['url']);
header('Content-Length: ' . strlen($image));
echo $image;
?>