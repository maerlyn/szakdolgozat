<?php


$opts = array('http' =>
    array(
        'method'  => 'POST',
        "header"   =>  "content-type: application/x-www-form-urlencoded",
        'content' => http_build_query(array(
            "client_id"     =>  "758449309528.apps.googleusercontent.com",
            "client_secret" =>  "ow-WSp58tesO44eubhw6nzQO",
            "redirect_uri"  =>  "http://jegyzokonyv.maerlyn.eu/oauth2callback",
            "grant_type"    =>  "authorization_code",
            "code"          =>  "4/CBrXfg0uaL-eXhhXsXHWr6G4Uwbj.AiZQ3drb1QsTOl05ti8ZT3b92TGifAI",
        )),
        'timeout' => 60,
    )
);

$context  = stream_context_create($opts);
$result = file_get_contents("https://accounts.google.com/o/oauth2/token", false, $context);

var_dump(json_decode($result, true));
