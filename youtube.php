<?php

function get_youtube($url){

 $youtube = "http://www.youtube.com/oembed?url=". $url ."&format=json";

 $curl = curl_init($youtube);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 $return = curl_exec($curl);
 curl_close($curl);
 return json_decode($return, true);

 }

$url = "https://www.youtube.com/watch?v=Uann2QflvAI"; 
$uur ="https://www.googleapis.com/youtube/v3/videos?id=_3LLkOOkkis&key=AIzaSyDD8BHuI-AC7zViW75GdvWKagHGL42t6pM&part=snippet,contentDetails,statistics,status";
// Display Data 
print_r(get_youtube($uur));


?>
