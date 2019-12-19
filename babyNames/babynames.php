<?php
// CSE 326 Web Application Development
// Lecture 13 Web Services - Exercise : Baby name web service

if (isset($_GET["type"])){
	$type = $_GET["type"];
	if($type != "list"){
		header("HTTP/1.1 400 Invalid Request");
		die("HTTP/1.1 400 Invalid Request - you passed in a wrong type parameter.");
	}
	nameList();
} else {
	babyname();
}

function nameList(){
	$names = "";
	$lines = file("rank.txt", FILE_IGNORE_NEW_LINES);
	foreach ($lines as $line) {
		$names = $names.substr($line, 0, strpos($line, " "))." ";
	}

	if ($names) {
		header("Content-type: text/plain");
		print trim($names);
	} else {
		header("HTTP/1.1 410 Gone");
		die("HTTP/1.1 410 Gone - There is no data!.");
	}
}


function babyname(){
	$name = get_parameter("name");
	$gender = get_parameter("gender");

	$baby_info = "";
	$lines = file("rank.txt", FILE_IGNORE_NEW_LINES);
	foreach ($lines as $line) {
		if (preg_match("/^$name $gender /", $line)) {
			$baby_info = $line;
			break;
		}
	}

	if ($baby_info) {
		// header("Content-type: text/plain");	//change header appropriately
		// print $baby_info; // remove this line
		header("Content-type: text/xml");
		print generate_xml($baby_info, get_parameter("name"), get_parameter("gender"))->saveXML();
		// call the generate_xml() function
		// send the XML data generated by the generate_xml() function to the client
	} else {
		header("HTTP/1.1 410 Gone");
		die("HTTP/1.1 410 Gone - There is no data for this name/gender.");
	}
}

/* Creates and returns an XML DOM tree for the given line of data.
 *
 * for the data, "Aaron m 147 193 187 199 250 237 230 178 52 34 34 41 55",
 * would produce the following XML:
 * <baby name="Aaron" gender="m">
 *    <rank year="1890">147</rank>
 *    <rank year="1900">193</rank>
 *    ...
 * </baby>
 *
 * Note that the year is from 1890 to 2010 and increasing by 10 for each record
 */
 function generate_xml($line, $name, $gender) {
     $xmldom = new DOMDocument();
     $baby_tag = $xmldom->createElement("baby");     # <baby>
     $baby_tag->setAttribute("name", $name);
     $baby_tag->setAttribute("gender", $gender);

     $year = 1890;
     $tokens = explode(" ", $line);
     for ($i = 2; $i < count($tokens); $i++) {
         $rank_tag = $xmldom->createElement("rank");   # <rank>
         $rank_tag->setAttribute("year", $year);
         $rank_tag->appendChild($xmldom->createTextNode($tokens[$i]));
         $baby_tag->appendChild($rank_tag);
         $year += 10;
     }

     $xmldom->appendChild($baby_tag);
     return $xmldom;
 }

function get_parameter($name) {
	if (isset($_GET[$name])) {
		return $_GET[$name];
	} else {
		header("HTTP/1.1 400 Invalid Request");
		die("HTTP/1.1 400 Invalid Request - you forgot to pass a '$name' parameter.");
	}
}
?>