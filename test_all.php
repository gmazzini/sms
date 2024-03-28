<?php
include "local.php";
for($num=0;$num<32;$num++){
  $fd=dio_open($mydev.$num,O_RDWR|O_NOCTTY|O_NONBLOCK);
  usleep(50000);
  dio_tcsetattr($fd,array("baud"=>115200,"bits"=>8,"stop"=>1,"parity"=>0,"flow_control"=>0,"is_canonical"=>0));
  usleep(50000);
  dio_write($fd,"AT\r");
  usleep(50000);
  $oo=trim(dio_read($fd));
  if(substr($oo,-2)=="OK")echo "$num:OK ";
  else echo "$num:NO ";
  usleep(50000);
  dio_close($fd);
}
echo "\n";
?>
