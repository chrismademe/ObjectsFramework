<?php

function get_objects( $args = null ) {

    /**
     * Get Objects class
     */
    global $objects;

    /**
     * Get objects
     */
    return $objects->get( $args );

}
