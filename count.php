<?php

$dd=$_GET["dd"];
exec("grep $dd /home/sent/* | wc -l",$oo);
echo $oo[0];

?>
