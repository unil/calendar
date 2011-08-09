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

$ip = "127.0.0.1";
preg_match_all("/\d+/", $ip, $matches);
$subdomain = (int)$matches[0][2];



print json_encode(array("ip" => $ip, "subdomain" => $subdomain));

/*
 * $.getJSON('getip.php', function(data){
  alert('Your ip is: ' +  data.ip);
});

 */
?>