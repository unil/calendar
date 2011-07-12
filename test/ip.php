<?php
/* getip.php */

if (!empty($_SERVER['HTTP_CLIENT_IP']))
{
  $ip=$_SERVER['HTTP_CLIENT_IP'];
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
{
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
{
  $ip=$_SERVER['REMOTE_ADDR'];
}



print json_encode(array('ip' => $ip));

/*
 * $.getJSON('getip.php', function(data){
  alert('Your ip is: ' +  data.ip);
});

 */
?>