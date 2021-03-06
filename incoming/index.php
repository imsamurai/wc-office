<?php
file_put_contents('data.json', json_encode($_GET+array('timestamp' => time())));
$connection = (!empty($_GET['connection']) && $_GET['connection'] <= 1 && $_GET['connection'] >= 0) ? $_GET['connection'] : 0;

?>settings = { 
  wifi = {
  retries = 5,
  default = <?= (int)$connection; ?>,
  connections = {{ 
         ssid = "imsamurai-mobile", 
         pass = "12332155" 
       },
       { 
         ssid = "ioix", 
         pass = "12345qwert" 
       },
       { 
         ssid = "hce-project", 
         pass = "zxd1-459l-9ggw1" 
       }}
  }, 
  send = { 
    host = "wc.office.imsamurai.me", 
    ip = "144.76.74.116", 
    path = "/incoming/", 
    template = 'return "&voltage="..voltage.."&ip="..ip.."&connection="..settings.wifi.default.."&mac="..wifi.sta.getmac()' 
  }, 
  sleep = { 
    timeout = 5, 
    wake = 10, 
    enable = true 
  } 
}
