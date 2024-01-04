<?php

    function textFilter($text)
    {
        $text = trim($text);
        $text = htmlentities($text, ENT_QUOTES);
        $text = stripslashes($text);
        return $text;
    }

    function htmlDecode($str){
        return strip_tags(html_entity_decode($str));
    }