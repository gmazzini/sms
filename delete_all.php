<?php

for($num=0;$num<32;$num++){
  $fd=dio_open("/dev/ttyCH9344USB".$num,O_RDWR|O_NOCTTY|O_NONBLOCK);
  usleep(100000);
  dio_tcsetattr($fd,array("baud"=>115200,"bits"=>8,"stop"=>1,"parity"=>0,"flow_control"=>0,"is_canonical"=>0));
  usleep(100000);
  dio_write($fd,"AT+CMGD=1,4\r");
  usleep(100000);
  $oo=dio_read($fd);
  echo "$num $oo\n";
  dio_close($fd);
}

?>
