<?php

function get_object( $ID ) {

    /**
     * Get Objects class
     */
    global $objects;

    /**
     * Get ID Type
     */
    $type = (is_string($ID) && !is_numeric($ID) ? 'alias' : 'ID');

    /**
     * Get objects
     */
    return $objects->get( array( $type => $ID ) );

}
