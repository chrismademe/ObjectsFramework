<?php

namespace Objects;

class Helpers {

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

}
