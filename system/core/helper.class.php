<?php

class Helper
{

    public static function xml_entities($string) {
        return strtr(
            $string, 
            array(
                "<" => "&lt;",
                ">" => "&gt;",
                '"' => "&quot;",
                "'" => "&apos;",
                "&" => "&amp;",
            )
        );
    }

}

