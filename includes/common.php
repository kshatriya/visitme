<?php
/*
Copyright 2010 GoPandas
This file is part of VisitME.

VisitME is free software: you can redistribute it and/or modify it
under the terms of the GNU General Public License as published by the
Free Software Foundation, either version 3 of the License, or (at your
option) any later version.

VisitME is distributed in the hope that it will be useful, but WITHOUT
ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License
for more details.

You should have received a copy of the GNU General Public License
along with VisitME. If not, see http://www.gnu.org/licenses/.
*/

require_once("sqlfunctions.php");

/** Takes in an origin code and an array of destination codes
 *
 *	This function provides 1->N location fares
 */
function get_fares_code_to_city($origin_code, $dest_codes, $debug)
{
	// Create URL string
	$rssURL = 'http://www.kayak.com/h/rss/fare?dest=';
	for ($i = 0; $i < sizeof($dest_codes) - 1; $i++)
	{
		$rssURL = $rssURL.$dest_codes[$i].",";
	}
	$rssURL = $rssURL.$dest_codes[sizeof($dest_codes) - 1];
	$rssURL = $rssURL.'&code='.$origin_code;
	
	// Get RSS feed
	$rss	= fetch_rss($rssURL);
	
	if($debug)
	{
		//echo "<br/>Fares url: $rssURL<br/>";
		//print_r($rss);
		//echo "<br/><br/>";
	}
	
	return $rss;
}

?>