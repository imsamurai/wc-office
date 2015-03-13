dofile("settings.lua");
pinLight = 4;
pinGround = 3;
debug = true;
ip = nil
voltage = node.readvdd33()

function runApp()
     pr("init template")
     local template = loadstring(settings.send.template)
     pr("init request")
     local request = "GET "..settings.send.path.."?light="..gpio.read(pinLight)..template().." HTTP/1.0\r\nHost: "..settings.send.host.."\r\n\r\n";

     pr("create connection...")
     local conn=net.createConnection(net.TCP, 0);
     pr("connection created!")
     
     conn:on("receive", function(conn, payload) 
          local _,_,s = string.find(payload, ".*\r\n\r\n(.*)");
          file.open("settings.lua", "w+")
          file.write(s)
          file.close()
          pr("Settings saved")
          dofile("settings.lua")
           pr("Settings loaded")
           conn:close() 
          --pr(s) 
     end );
     --conn:on("sent",function(conn) 
     --     conn:close() 
     --end)

     pr("connect...")
     conn:connect(80, settings.send.ip)
     pr("connected!")
     pr("sending...")
     conn:send(request)
     --conn:send("GET "..settings.send.path.."?".."light="..gpio.read(pinLight).."&voltage="..node.readvdd33().."&ip="..wifi.sta.getip().." HTTP/1.0\r\nHost: "..settings.send.host.."\r\n\r\n")
     pr("sent!")
     if settings.sleep.enable then
          tmr.alarm(0, 1000*settings.sleep.timeout, 0, function() node.dsleep(1000000*settings.sleep.wake) end )
          pr("go to sleep")
     else
         tmr.alarm(0, 1000*settings.sleep.wake, 0, startApp)
         pr("waiting to start")
         collectgarbage()
         pr("trash")
     end   
end

function initApp() 
     gpio.mode(pinLight, gpio.INPUT);
     gpio.mode(pinGround, gpio.OUTPUT);
     gpio.write(pinGround, gpio.LOW);
     wifi.setmode(wifi.STATION)
     wifi.sta.config(settings.wifi.ssid,settings.wifi.pass)
end

function startApp()
     --collectgarbage()
     --pr(node.heap())
     tmr.alarm(1, 1000, 1, function() 
        ip = wifi.sta.getip()
        if not ip then
           pr("Connect AP, Waiting...") 
        else
           tmr.stop(1)
           runApp()
           --tmr.alarm(2, 10000, 1, startApp)
        end
     end)
end

function pr(val) 
     if (debug) then
          return print(val);
     end
end
initApp()
startApp() 
