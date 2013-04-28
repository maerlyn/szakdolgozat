<?php

$url = "https://accounts.google.com/o/oauth2/auth?" . http_build_query(array(
    "response_type" =>  "code",
    "redirect_uri"  =>  "http://jegyzokonyv.maerlyn.eu/oauth2callback",
    "scope"         =>  "https://www.googleapis.com/auth/calendar",
    "access_type"   =>  "offline",
    "approval_prompt"   =>  "force",
    "client_id"     =>  "758449309528.apps.googleusercontent.com",
));

var_dump($url);
