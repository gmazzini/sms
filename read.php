<?php
include "local.php";
$num=$argv[1];
$fd=dio_open($mydev.$num,O_RDWR|O_NOCTTY|O_NONBLOCK);
usleep(100000);
dio_tcsetattr($fd,array("baud"=>115200,"bits"=>8,"stop"=>1,"parity"=>0,"flow_control"=>0,"is_canonical"=>0));
usleep(100000);
dio_write($fd,"AT+CMGL=\"ALL\"\r");
usleep(100000);
$oo=dio_read($fd);
echo $oo;
dio_close($fd);
?>
