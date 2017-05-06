<?php

class Text {

    public static function safe($str) {
        return trim(htmlspecialchars(strip_tags((get_magic_quotes_gpc() ? stripslashes($str) : $str))));
    }

}