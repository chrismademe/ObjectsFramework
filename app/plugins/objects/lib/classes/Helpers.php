<?php

namespace Objects;

class Helpers {

    /**
     * Database Object
     */
    public static function db() {
        global $medoo;
        return $medoo;
    }

    /**
     * Database Table Name
     */
    public static function table( $name ) {
        return $name;
    }

    /**
     * Database Quote
     */
    public static function quote( $string ) {
        return '`'. $string .'`';
    }

    /**
     * Database Date
     *
     * Return MySQL timestamp
     */
    public static function timestamp( $time = false ) {

        // Format
        $format = 'Y-m-d H:i:s';

        // Return set timestamp
        if ( $time ) {
            return date($format, strtotime($time));
        }

        // Return current timestamp
        return date($format);

    }

    /**
     * Alias
     */
    public static function alias( $string ) {
        return strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $string));
    }

    /**
     * Dump
     */
    public static function dump( $array ) {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

}
