<?php
file_put_contents('data.json', json_encode($_GET+array('timestamp' => time())));


?>settings = {
  wifi =  {
    ssid = "ioix-II",
    pass = "3sL7UGpX"
  },
  send = {
    host = "wc.office.imsamurai.me",
    ip = "144.76.74.116",
    path = "/incoming/",
    template = 'return "&voltage="..voltage.."&ip="..ip'     
  },
  sleep = {
    timeout = 3,
    wake = 10,
    enable = false
  }
}
