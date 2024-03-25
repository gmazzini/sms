<?php

$fp=fopen("/home/inout","w+");
$modem=0;
for(;;){
  $buf=fgets($fp);
  $q=explode("|",trim($buf));
  $num="+".$q[0]; $msg=$q[1];
  for(;;){
    $ss=0;
    $fd=dio_open("/dev/ttyCH9344USB".$modem,O_RDWR|O_NOCTTY|O_NONBLOCK);
    usleep(100000);
    dio_tcsetattr($fd,array("baud"=>115200,"bits"=>8,"stop"=>1,"parity"=>0,"flow_control"=>0,"is_canonical"=>0));
    usleep(100000);
    dio_write($fd,"AT+CREG?\r");
    usleep(100000);
    $oo=trim(dio_read($fd));
    $cc=substr($oo,20,1);
    if($cc=="1"){
      echo "modem=$modem|num=$num|msg=$msg\n";
      dio_write($fd,"AT+CMGF=1\r");
      usleep(100000);
      $oo=dio_read($fd);
      dio_write($fd,"AT+CMGS=\"$num\"\r");
      usleep(100000);
      $oo=dio_read($fd);
      dio_write($fd,"$msg\x1A");
      usleep(100000);
      $oo=dio_read($fd);
      $ss=1;
      file_put_contents("/home/sent/".$modem.".txt",date("YmdHis").PHP_EOL,FILE_APPEND|LOCK_EX);
    }
    dio_close($fd);
    $modem++;
    if($modem>=32)$modem=0;
    if($ss)break;
  }
}

?>
