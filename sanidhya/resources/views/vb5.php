<?php

$fh = fopen('documents/abc.txt','r');
while ($line = fgets($fh)) {
   echo($line);
   echo "<br>";
}
fclose($fh);

?>
sdf