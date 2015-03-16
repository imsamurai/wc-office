settings = { 
  wifi = {
  retries = 5,
  default = 0,
  connections = {{ 
         ssid = "ioix-II", 
         pass = "3sL7UGpX" 
       },
       { 
         ssid = "ioix", 
         pass = "12345qwert" 
       },
       { 
         ssid = "hce-project", 
         pass = "zxd1-459l-9ggw" 
       }}
  }, 
  send = { 
    host = "wc.office.imsamurai.me", 
    ip = "144.76.74.116", 
    path = "/incoming/", 
    template = 'return "&voltage="..voltage.."&ip="..ip.."&connection="..settings.wifi.default' 
  }, 
  sleep = { 
    timeout = 5, 
    wake = 10, 
    enable = false 
  } 
}
