<?php

class Helper
{
    public static function decode($json) {
        return json_decode($json);
    }

    public static function filter($param) {
        return htmlspecialchars(trim(strip_tags($param)));
    }
}