<?php
/*
This file is free software: you can redistribute it and/or modify
the code under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version. 

However, the license header, copyright and author credits 
must not be modified in any form and always be displayed.

This class is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

@author geoPlugin (gp_support@geoplugin.com)
@copyright Copyright geoPlugin (gp_support@geoplugin.com)

*/

require_once('geoplugin.class.php');

$geoplugin = new geoPlugin();

$user_ip = "106.51.125.129";
//locate the IP
$geoplugin->locate($user_ip);    //Put require IP in the locate() function.

echo "Geolocation results for {$geoplugin->ip}: <br />\n".
	"City: {$geoplugin->city} <br />\n".
	"Country Name: {$geoplugin->countryName} <br />\n".
	"Currency: {$geoplugin->currencyCode} <br />\n"

?>