<?php 
$data = json_decode(file_get_contents('incoming/data.json'), true);
?>
<!DOCTYPE html>
<html xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="//wc.office.imsamurai.me//jquery-1.11.2.min.js"></script>
<script lang="text/javascript">
  var _data = false;
  var app = function() {
    var timeout = 10;
    $.ajax({url: "incoming/data.json", success:function( data ) {
      if (_data && _data.light != data.light && data.light == "0") {
        var snd = new Audio("toilet.mp3");
        snd.play();
      }
      if ((new Date).getTime()/1000 - data.timestamp > 5 * 60) {
        $("#sensor").removeClass('open').removeClass('closed').addClass('error').html('ERROR, PLEASE CHECK SENSOR!');
      else {
        if (data.light == "1") {
          $("#sensor").removeClass('open').addClass('closed').html('OCCUPIED...');
        } else {
          $("#sensor").removeClass('closed').addClass('open').html('FREE!');
        }
      }
      $("#voltage").html((data.voltage/1000));
      $("#ip").html(data.ip);
      $("#connection").html("#"+data.connection);
      $("#date").html(new Date(data.timestamp*1000));
      _data = data;
      setTimeout(app, timeout*1000)
    }, cache: false});
  };
  app();
</script>
<style>
body {
  margin: 0 auto;
  text-align: center;
}
#voltage, #ip, #date {
  padding:5px;
}
#sensor {
  font-size: 32px;
  font-weight: bold;
  padding:10px;
}
.open {
    background-color: green;
    color: black;
} 
.closed {
  background-color: red;
  color: white;
}
.error {
  background-color: orange;
  color: white;
}
</style>
<title>IOIX toilet</title>
</head>
<body>
<div id="sensor"></div>
<div><b>Voltage: </b><span id="voltage"></span></div>
<div><b>IP: </b><span id="ip"></span></div>
<div><b>Last received on: </b><span id="date"></span></div>
<div><b>Connection: </b><span id="connection"></span></div>
</body>
</html>

