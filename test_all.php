<?php

for($num=0;$num<32;$num++){
  $fd=dio_open("/dev/ttyCH9344USB".$num,O_RDWR|O_NOCTTY|O_NONBLOCK);
  dio_tcsetattr($fd,array("baud"=>115200,"bits"=>8,"stop"=>1,"parity"=>0,"flow_control"=>0,"is_canonical"=>0));
  sleep(2);
  dio_write($fd,"AT+CIMI;+GSN;+CREG?\r");
  usleep(1000000);
  $oo=dio_read($fd);
  echo "$num $oo\n\n";
  sleep(1);
  dio_close($fd);
}

?>
