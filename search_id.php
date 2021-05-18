<?php
$file = 'nquotes.txt';
$searchfor = '95440';

// the following line prevents the browser from parsing this as HTML.

// get the file contents, assuming the file to be readable (and exist)
$contents = file_get_contents($file);
// escape special characters in the query
$pattern = preg_quote($searchfor, '/');
// finalise the regular expression, matching the whole line
$pattern = "/^.*$pattern.*\$/m";
// search, and store all matching occurences in $matches
if(preg_match_all($pattern, $contents, $matches)){

    echo implode("\n", $matches[0]);
    return "true";
}
else{
    return "false";
}
?>