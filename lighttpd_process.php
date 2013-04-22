<?php
/*
Loop
*/

$lines = file('/opt/raspberry-simplicity-api/lighttpd.queue');
file_put_contents('/opt/raspberry-simplicity-api/lighttpd.queue',null);

foreach ($lines as $line) {
	$t = trim($line);

	if($t == 'reboot')
		exec('sudo reboot');

}
