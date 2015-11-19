<?php

function object_exists( $ID ) {

    /**
     * Get Objects class
     */
    global $objects;

    /**
     * Run query
     */
    return $objects->exists($ID);

}
